---
target: Trang Phương pháp (method.blade.php)
total_score: 15
max_score: 20
na_heuristics: 3,5,7,9,10
p0_count: 0
p1_count: 2
timestamp: 2026-08-13T04-36-52Z
slug: resources-views-client-method-blade-php
---
Method: dual-agent (A: a697fccc8472409e7 · B: a1670572cb153ccc6)

## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 3 | Scroll-ignite gives real (if silent) feedback; no async/loading concerns on a static page |
| 2 | Match Between System and Real World | 4 | Vietnamese parent-register copy throughout, football-grounded metaphors (trọng tài, đồng đội, trên sân) |
| 3 | User Control and Freedom | n/a | No modal/flow state to escape on a static marketing page |
| 4 | Consistency and Standards | 2 | `.pillar-card` has no `.reveal`/`.reveal-dN` while every sibling card grid does - three different entrance behaviors in three consecutive sections |
| 5 | Error Prevention | n/a | No form/input on this page |
| 6 | Recognition Rather Than Recall | 3 | Every icon paired with a text label; no memory burden |
| 7 | Flexibility and Efficiency of Use | n/a | Persuade-mode page, no expert path applicable |
| 8 | Aesthetic and Minimalist Design | 3 | Clean overall; the connecting-line SVG carries a real distortion risk (below) |
| 9 | Help Users Recognize/Recover from Errors | n/a | No error states present |
| 10 | Help and Documentation | n/a | Not applicable to a marketing page |
| **Total** | | **15/20** | **75% - Good** |

(Assessment A's own arithmetic reported 15/24; corrected here - 5 heuristics were scored n/a, so the applicable max is 5×4=20, not 24. 15/20 is 75%, solidly Good, not "edge of Acceptable" as A's miscalculation suggested.)

## Design Specificity Verdict

**LLM assessment (Assessment A):** Mixed. The macro-structure - banner → 2-card intro → 4-card detail grid → 4-card bento → contained values banner → closing CTA - is generic "premium kids'-program page" scaffolding that could belong to any activity brand with a repaint; nothing in the container choices (grid counts, card shapes, section order) is football-specific on its own. What earns it back is the copy layer: the C.A.R.E letter names and the four named "tư duy" pillars are specific, football-grounded program vocabulary (trọng tài, đồng đội, trên sân), not filler, and the bento's ghost-numeral/gold-ignite/connecting-line mechanic is a genuinely bespoke interaction, not a template import. Net: authored copy riding on a somewhat generic shell.

**Deterministic scan (Assessment B):** `node detect.mjs --json resources/views/client/method.blade.php` → **exit 0, zero findings**. No inline styles, no hardcoded hex colors, no hardcoded radius values anywhere in `method.css` - every color and radius routes through a `var(--*)` token. This is a clean bill on the mechanical layer; it says nothing about compositional genericness, which is Assessment A's call above.

**Visual overlays:** Not available this session - the Chrome extension was declined, so no live browser injection/overlay pass ran. Both agents worked from source only; every claim about rendered geometry (below) is inferred from code, not observed pixels.

## Overall Impression

The page is disciplined and on-system - it does not break a single DESIGN.md rule, and the detector agrees. The real risk isn't rule-breaking, it's that the newest section (the pillar bento you just spent four rounds tuning) has one concrete, checkable geometry bug and loses its entire reason for existing on mobile, where most parents will actually see it. Everything else is second-order: pacing, a missing mid-page nudge, one stale doc paragraph.

## What's Working

- **Ghost-numeral ignite mechanic.** A 72px near-invisible numeral brightening to `--accent-text` at 14% opacity on activation numbers four items without color-coding them - exactly what DESIGN.md's Do's list asks for, executed with real restraint rather than loudness.
- **C.A.R.E letter badges as flat gold circles**, explicitly rejecting the source mockup's per-letter rainbow palette. A real discipline call under pressure from a colorful reference - the Two-Gold Rule held.
- **Hover-preview parity on `.pillar-card`.** Hovering shows the same border/icon state the scroll-ignite will eventually apply, teaching the interaction before it fires - a small, real affordance win neither agent had to strain to find.

## Priority Issues

**[P1] The connecting-line SVG is drawn in a coordinate space that doesn't match its container's shape.**
- **Why it matters:** `.pillar-bento__line` uses `viewBox="0 0 100 100" preserveAspectRatio="none"` (confirmed verbatim by Assessment B) stretched over `.pillar-bento`, a `grid-template-columns: 1fr 1fr` two-column grid whose rendered box is nowhere near square at desktop widths. A square viewBox forced non-uniformly onto a wide rectangle scales X and Y independently - the path's stroke width goes anisotropic and the `r="1.6"` touch-point dots stop being circles. This is the section's single signature decorative device; if it renders visibly warped, it undercuts the exact "differentiated, premium" read the redesign was built to deliver. Both agents converged on this independently (A from the math, B from reading the raw attributes), which is a strong signal it's real, not a false alarm.
- **Fix:** Either set `preserveAspectRatio="xMidYMid meet"` with a viewBox that matches the container's actual aspect ratio, or measure the real rendered width/height in JS and set the viewBox dynamically before drawing the path.
- **Suggested command:** `/impeccable harden`

**[P1] The section's one differentiator from C.A.R.E disappears exactly where most parents will view the page.**
- **Why it matters:** `.pillar-bento__line { display: none }` below 700px (`method.css:198-201`). On mobile, the pillar section collapses to a plain single-column stack of 4 bordered cards - visually near-indistinguishable from the C.A.R.E cards two sections above, which was the specific repetition risk the bento redesign was built to solve. The fix works on desktop and fails silently on the device most Vietnamese parents will actually be holding.
- **Fix:** Give mobile its own differentiator instead of just hiding the desktop one - e.g. a simple vertical connecting line/rail between stacked cards (same ignite mechanic, 1-D instead of 2-D), rather than nothing.
- **Suggested command:** `/impeccable adapt`

**[P2] No secondary conversion nudge across the page's longest, densest stretch.**
- **Why it matters:** C.A.R.E (4 cards) → pillar bento (4 cards) → heart-banner run back to back with zero CTA or branch-finder link between them - the longest content run on the site with the lowest CTA density. PRODUCT.md states plainly that "every parent-facing surface should shorten the path to booking a trial," and About already set the precedent (`.club-intro__branch-link`) for a light-touch text link doing exactly this without competing with the primary CTA.
- **Fix:** Add one text-link nudge (not a second button) toward `route('branch.index')` or `registration.create` after the C.A.R.E or pillar section.
- **Suggested command:** `/impeccable clarify`

**[P3] `.pillar-card` intentionally has no entrance reveal - worth a conscious yes, not a silent default.**
- **Why it matters:** Confirmed in the blade file: `value-pair__card` and `care-detail-card` both carry `reveal reveal-dN`; `pillar-card` carries neither. This was a deliberate substitution made earlier in this thread (replacing fade-in with the scroll-ignite per explicit request), not an oversight - but the *result* is three different entrance languages in three consecutive card sections, which is exactly what Heuristic 4 (Consistency) measures regardless of intent. Not asking you to revert it; flagging it so it's a decision you're making on purpose rather than one that just happened.
- **Fix:** Either leave as-is deliberately (valid, since the ignite already carries the "this section is different" signal), or add a very light shared fade-in under the ignite so the section doesn't feel like it skipped the site's baseline entrance convention entirely.
- **Suggested command:** `/impeccable polish`

**[P3] Content-bearing C.A.R.E photos carry `alt=""`.**
- **Why it matters:** Confirmed by Assessment B: lines 73, 86, 99, 112 all have empty alt text with no `aria-hidden` wrapper, unlike the hero/heart-banner/closing-cta background photos which are correctly wrapped as decorative. These four specifically show the teaching method in action - a screen-reader user loses that content entirely. (The background photos elsewhere on the page are legitimately decorative and not part of this finding.)
- **Fix:** Populate real alt text per C.A.R.E letter (e.g. "Huấn luyện viên khen ngợi học viên sau một pha xử lý tốt" for CELEBRATE).
- **Suggested command:** `/impeccable harden`

**Not flagged as a defect (correcting the record):** Assessment B factually confirmed no `@media (prefers-reduced-motion: reduce)` exists for the new `.pillar-bento`/`.pillar-card` transitions. This is not a gap - DESIGN.md documents standing site-wide precedent that reduced-motion gating has repeatedly shipped and repeatedly read back as "broken," not as an accommodation, and the reveal system already skips it project-wide. Consistent with that precedent, not a miss.

**Not flagged as a defect (contextualizing a number):** Assessment B computed the ghost numeral's contrast at roughly 1.1–1.2:1 against its card background. That's expected, not accidental - the brief for this element was specifically "near-invisible ghost numeral," the same design language as the site's other decorative-only large numerals. WCAG text-contrast minimums don't govern purely decorative background glyphs; flagging only so the number doesn't get mistaken for an oversight later.

## Persona Red Flags

**Jordan (first-timer parent):** "C.A.R.E" and "tư duy" are both defined on first use, which is good. But by the time Jordan reaches `.heart-banner`, they're looking at a *third* restatement of the same 5 values (Kỷ luật, Tôn trọng, Nỗ lực, Đoàn kết, Tiến bộ) already shown on the About page - with no signal that this is intentional reinforcement rather than redundant content. Nothing on the page tells Jordan "you've seen this before, here's why it's repeated."

**Casey (distracted mobile parent):** Already covered above as a P1 - the bento's signature interaction vanishes below 700px, leaving Casey with a plain card stack.

**Riley (stress tester):** `initPillarBento()`'s activation math has been retuned three times this session against desktop assumptions, using the block's own rendered height (which changes shape entirely once the grid collapses to a single column on mobile). Neither agent had browser access to confirm the stagger still feels reasonable on a real narrow viewport rather than dumping all four cards into `is-active` in a rushed burst - this is the single highest-value thing to check by hand before calling this section done.

## Minor Observations

- `DESIGN.md`'s own "Page: Phương pháp (Method)" section is now stale - it still describes `.pillar-strip` ("new `.pillar-strip`, deliberately not a second sticky-scroll stack") and hasn't been updated to reflect the `.pillar-bento` rework. Not fixing this automatically per this skill's own rule against silently repairing doc drift - flagging it for whenever this section is considered final.
- `care-detail-card` and `pillar-card` both jump from the section's `<h2>` straight to `<h4>`, skipping `<h3>` - `value-pair__card` two sections earlier uses `<h3>`. Inconsistent heading depth across the page, invisible visually but real for screen-reader heading navigation.
- At the 700–900px breakpoint, `.care-detail-grid` and `.pillar-bento` both resolve to identical `grid-template-columns: 1fr 1fr` with matching gap/radius/border - the two sections built specifically to *not* look alike converge in exactly the tablet range most real devices sit in.
- `.closing-cta__note` carries no cost/commitment reassurance ("miễn phí," "không ràng buộc," etc.) right before the page's one and only ask - a light touch, not urgent, but the highest-stakes sentence on the page currently does the least reassurance work.
