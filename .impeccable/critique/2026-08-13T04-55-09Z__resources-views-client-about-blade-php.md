---
target: Trang Về CLB (about.blade.php) — mobile
total_score: 13
max_score: 20
na_heuristics: 1,5,7,9,10
p0_count: 1
p1_count: 2
timestamp: 2026-08-13T04-55-09Z
slug: resources-views-client-about-blade-php
---
Method: dual-agent (A: a871e5eee152d243e · B: a95ad2e9eab4b9018) — scope: mobile experience of Về CLB (About)

## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | n/a | Static content page, no async state |
| 2 | Match Between System and Real World | 3 | Vietnamese copy natural throughout |
| 3 | User Control and Freedom | 3 | Nav always reachable via hamburger; no dead ends |
| 4 | Consistency and Standards | 2 | Three different collapse breakpoints (700/760/800px) for conceptually similar card grids on one page |
| 5 | Error Prevention | n/a | No forms on this page |
| 6 | Recognition Rather Than Recall | 3 | Icon+label cards throughout, nothing icon-only |
| 7 | Flexibility and Efficiency | n/a | Persuade-mode page |
| 8 | Aesthetic and Minimalist Design | 2 | The system's one heading-emphasis device is nearly invisible (below) |
| 9 | Error Recovery | n/a | No errors possible |
| 10 | Help and Documentation | n/a | Not applicable to a Persuade page |
| **Total** | | **13/20** | **65% — Acceptable** |

(Assessment A reported 13/24; corrected — 5 heuristics scored n/a, applicable max is 5×4=20. 13/20 is 65%, Acceptable band, not the 54% A's arithmetic implied.)

## Design Specificity Verdict

**LLM assessment (A):** Mostly still authored, not shrunk-desktop — the banner's flat scrim, the letter-block's forced narrowness, and the gold/ink palette all carry through single-column collapse without turning generic. Two things A flagged as doc/code mismatches (DESIGN.md describing a second closing-CTA button and a `.value-rows` component that no longer exist) turned out, per Assessment B's independent grep, to be real: the page evolved past what DESIGN.md documents. That's a documentation problem, not a design-quality one — noted below, not scored against the page.

**Deterministic scan (B):** `detect.mjs` → exit 0, zero findings. No inline styles, no hardcoded hex, no bypassed tokens. Clean on the mechanical layer, as with every prior scan on this project.

**Independent verification (mine):** I re-grepped `base.css` myself rather than take either agent's word on the single most consequential number in this report — confirmed below.

## Overall Impression

Mobile collapse is competent, not lazy — nothing here reads as an afterthought shrink of the desktop layout. But there is one real, site-wide, currently-live bug underneath the About-mobile question you asked: the token that drives the page's entire heading-emphasis system is close to invisible. Everything else is genuine but second-order: breakpoint rhythm, a hero that wastes a fifth of a short phone's screen before any content, and a documentation file that's drifted out of sync with the actual "Giá trị cốt lõi" component in three separate ways.

## What's Working

- **Banner scrim survives narrow widths without redesign.** A flat `rgba(16,16,16,.76)` overlay (not a gradient tuned for a wide aspect) doesn't degrade as the box narrows — the actual shipped alpha (.76) is stronger than DESIGN.md's documented .6, which only helps: worst-case contrast against a pure-white photo pixel computes to ≈9:1, AAA-level, and realistic photo tones push well past that.
- **The letter-block's narrow column reads even better on mobile than desktop** — a phone is already narrow, so the "intimate, not a data block" intent DESIGN.md describes lands naturally.
- **Single-button closing CTA is the right call for 390px**, whatever the (stale) doc says — no button-cramming risk on a narrow screen.

## Priority Issues

**[P0] The site's only heading-emphasis token fails contrast badly, live, right now.**
- **What:** `base.css:9` — `--accent-text: #f3ae00`. DESIGN.md's frontmatter documents this token as `#815D03` (previously verified at 5.74:1 against paper). The shipped value is different. I recomputed the contrast myself: `#f3ae00` on `--paper` (#FAFAFA) → **≈1.85:1** — fails WCAG AA even at the large-text 3:1 threshold, let alone normal-text 4.5:1. `git blame` shows this line as uncommitted, edited today — this isn't old debt, it's a live, very recent change.
- **Why it matters:** this token drives `.hl` (the highlighted word in every section heading, 3× on this page alone), the drop-cap letter in the letter-block, and every `.icon-roundel` stroke — it is not an About-page issue, it is the single accent-text role used site-wide per the Two-Gold Rule. On mobile specifically, where a parent skims fast and may be outdoors in glare, a washed-out emphasis word defeats the one hierarchy signal headings have, and a low-contrast brand color reads as unpolished rather than "premium academy."
- **Context, not excuse-making:** this lines up with earlier project feedback that the client approved a brighter `#ffc200`-family gold and that `--accent-text` specifically still needed a contrast pass to catch up — it looks like that pass landed on a value that's brighter but not text-safe, not that anyone shipped it carelessly.
- **Fix:** pick a value in the same gold family that clears AA as text on `--paper`/`--paper-alt` — DESIGN.md's own previously-verified `#815D03` is the known-safe anchor; if the brighter direction is wanted specifically for this token too, it needs a fresh contrast check before shipping, not a visual guess.
- **Suggested command:** `/impeccable harden`

**[P1] Three different collapse breakpoints for conceptually similar grids, all clustered in the same tablet band.**
- **What:** `.value-pair` collapses at 800px (`base.css:202`), `.value-bento` at 700px (`about.css:9`), `.letter-block` at 760px (`about.css:197`) — confirmed verbatim by Assessment B. At ~750px, `.value-pair` is already single-column while `.value-bento` is still forced into 3 columns (interior text ≈178px wide after padding).
- **Why it matters:** right after the page goes single-column for trust content, it snaps back to a cramped 3-up grid for values, then single-column again for the letter — an inconsistent rhythm in exactly the width band most real tablets and large phones sit in.
- **Fix:** align all three to one shared breakpoint variable.
- **Suggested command:** `/impeccable layout`

**[P1] 152px of fixed top padding on the banner never shrinks for mobile.**
- **What:** `base.css:266` — `padding-block: calc(var(--header-height) + 64px) 56px`, no override anywhere; `--header-height` (88px) is also constant across breakpoints. Confirmed by B.
- **Why it matters:** on a short phone (iPhone SE-class, 667px tall) that's ≈23% of the viewport as blank space before the headline even appears — a real delay to first meaningful content for a fast-scrolling visitor.
- **Fix:** add a mobile-width reduction to the 64px offset, the same way `--section-gap-mobile` already exists for `.section`.
- **Suggested command:** `/impeccable layout`

**[P2] No secondary conversion path on mobile between the hero and the closing band.**
- **What:** `layout.css:179` hides `.site-header__cta` below 992px; the only rescue is the hamburger drawer (2 taps). About itself has zero secondary CTA of its own.
- **Why it matters:** a distracted parent who decides mid-scroll has no one-tap path to registration.
- **Fix:** a light-touch in-context prompt after the letter-block, or a persistent bottom-sheet CTA on long content pages.
- **Suggested command:** `/impeccable shape`

**[P3] Drop-cap size has no mobile override — worth a quick look, not confirmed broken.**
- **What:** `3.4rem`, fixed, `about.css:148-157`, no override in the 760px media query. Assessment A's own visual read called it "proportionally reasonable, not broken" in a ~358px column at 390px width — flagging for verification, not asserting a defect.
- **Fix:** if it does look heavy on a real device, clamp it down at the 760px breakpoint alongside the rest of `.letter-block`'s mobile adjustments.
- **Suggested command:** `/impeccable adapt`

## Persona Red Flags

**Casey (distracted mobile parent):** hits 152px of dead space before the headline; scrolls past 5 structurally-identical `.value-bento` cards with no chunk markers, easy to lose her place; if she decides to convert partway through, the header CTA is gone below 992px and she has to find the hamburger; the washed-out `.hl` token means she can't quickly skim which word in each heading is the point.

**Jordan (first-timer parent):** no jargon issues, plain Vietnamese throughout — her risk is purely visual. A near-invisible accent color reads as an unfinished or unpolished site to someone evaluating "is this club legitimate," a small but real trust ding on a first visit.

## Minor Observations

- DESIGN.md is stale on this page in more than one way, not just the accent token: "Giá trị cốt lõi" is documented as `.value-rows`/`.value-row` but the shipped component is `.value-bento`/`.value-card` (a different, undocumented redesign); the closing CTA is documented with a second `.btn--outline-invert` button that doesn't exist in current markup; a `clamp(220px, 30vw, 380px)` page-hero photo height is documented but absent from the live CSS; the scrim alpha is documented as `.6` but ships as `.76`. Not auto-fixing any of this per the skill's own rule against silently repairing doc drift — flagging as a batch for whenever this page is next touched.
- `.icon-roundel svg` stroke also uses the broken `--accent-text` token (`base.css:249`) — every decorative icon on every card is equally washed out, not just the heading highlights.
- A configured-but-empty `about_letter_photo` falls back to a flat `--paper` box with no placeholder icon, unlike `.letter-empty`'s honest dashed-hairline treatment elsewhere on the same page — a silent-empty edge case rather than an honest one.
- Touch targets are fine: the one interactive element on the page (`.btn--accent`) computes to ≈52px tall by the declared padding/line-height, comfortably clearing the 44px guideline.

## Provocative Questions

- The accent-text regression looks tied to the client's approved brighter-gold direction — is the fix "pick one darker value and lock it," or does the brand want a genuinely different text-safe gold that still reads as part of the brighter family?
- If "Giá trị cốt lõi" quietly evolved from `.value-rows` to `.value-bento` without DESIGN.md catching up, what else on this page has drifted from its documented intent?
- Is the hamburger-only mobile CTA path acceptable for every page, or does a long content page like About specifically need its own mid-scroll conversion moment?
