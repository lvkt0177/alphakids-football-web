---
name: Alpha Kids Football Club
description: Premium Sports Editorial — a black, white, and gold academy site for parents, built on a full greenfield redesign with bento grids and mesh gradients.
colors:
  ink: "#101010"
  ink-soft: "#4A4A4A"
  ink-faint: "rgba(16, 16, 16, 0.12)"
  paper: "#FAFAFA"
  paper-alt: "#F1F0F0"
  accent: "#ffc200"
  accent-dark: "#ebbc21"
  accent-text: "#815D03"
  accent-soft: "#F6EFD9"
  white: "#FFFFFF"
  hero-empty-glow: "#232323"
  hero-mesh-gold: "rgba(201, 162, 39, 0.22)"
  hero-scrim-black: "rgba(0, 0, 0, 0.97)"
  cta-hover-ink: "#050505"
  mobile-menu-scrim: "rgba(34, 27, 51, 0.5)"
typography:
  display-hero:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(2.8rem, 6.4vw, 4.8rem)"
    fontWeight: 900
    lineHeight: 0.92
  display-hero-accent:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(3.8rem, 9.6vw, 7.6rem)"
    fontWeight: 900
    lineHeight: 0.92
  display:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(2.2rem, 3.6vw, 3.2rem)"
    fontWeight: 800
    lineHeight: 1.05
  display-sm:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(1.5rem, 2.4vw, 1.9rem)"
    fontWeight: 800
  display-cta:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(2.1rem, 4vw, 3rem)"
    fontWeight: 800
  display-letter:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(2.8rem, 5.4vw, 4.4rem)"
    fontWeight: 900
  display-index:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "1.15rem"
    fontWeight: 800
  display-timeline-num:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(3.4rem, 7vw, 6rem)"
    fontWeight: 900
  display-timeline-heading:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(1.8rem, 3vw, 2.6rem)"
    fontWeight: 800
  display-club-intro:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(2rem, 3.2vw, 2.8rem)"
    fontWeight: 800
  quote:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "clamp(1.4rem, 2.4vw, 1.9rem)"
    fontWeight: 700
  subtitle:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "clamp(1rem, 1.7vw, 1.15rem)"
    fontWeight: 600
  lead:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "18px"
    fontWeight: 600
  lead-alt:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "17px"
    fontWeight: 500
  quote-glyph:
    fontFamily: "Archivo, Be Vietnam Pro, sans-serif"
    fontSize: "4.5rem"
    fontWeight: 900
  body:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "16px"
    fontWeight: 500
    lineHeight: 1.7
  body-sm:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "14.5px"
    fontWeight: 500
  label:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "14px"
    fontWeight: 600
  small:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "13.5px"
    fontWeight: 500
  caption:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "12.5px"
    fontWeight: 500
  micro:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "11.5px"
    fontWeight: 700
  logo-text:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "19px"
    fontWeight: 800
  menu-close:
    fontFamily: "Be Vietnam Pro, sans-serif"
    fontSize: "20px"
    fontWeight: 400
rounded:
  sm: "8px"
  md: "14px"
  lg: "20px"
  xl: "28px"
  toast: "10px"
  pill: "999px"
  legacy-chip: "2px"
spacing:
  section: "120px"
  section-mobile: "64px"
components:
  button-primary:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: "14px 28px"
  button-outline:
    backgroundColor: "transparent"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: "14px 28px"
---

# Design System: Alpha Kids Football Club

## Overview

**Creative North Star: "Premium Sports Editorial"**

This is a Full Greenfield Redesign (v3) that discards the prior "Modern Sports Editorial" identity's purple accent entirely and rebuilds the color and motion system from zero, while keeping the layout-family thinking that pass had already earned (bento grids, sticky-scroll stack, manifesto list, carousels — see Layout). The palette is now black, white, and gold: near-black ink, off-white paper, and exactly one metallic-gold accent, chosen deliberately over the more predictable "football club color" defaults (red, blue) because gold reads as trophy, medal, and academic excellence, matching "học viện cao cấp" (premium academy) positioning more precisely than a team-kit hue.

**Dials (design-taste-frontend methodology): `DESIGN_VARIANCE 9` · `MOTION_INTENSITY 8` · `VISUAL_DENSITY 3`.** Set per explicit user instruction for this greenfield pass ("bứt phá hoàn toàn khỏi mọi layout SaaS truyền thống" / break completely from conventional SaaS layouts). Variance 9 means the page leans harder into bento asymmetry, mesh-gradient depth, and oversized editorial type than the v2 pass (variance 8). Motion 8 adds a genuine scroll-linked mesh drift in the hero and a gold "light-catch" shimmer sweep on primary CTAs, on top of the parallax, sticky-scroll rail, reveal-stagger, and carousel already established.

Confirmed visual rejections: the purple accent and every token built on it; the whiteboard/marker world from the pass before that (dashed arrows, hand-marker type, dot-grid texture); a repeated "N equal items in a row" grid used across more than one section (Section-Layout-Repetition Ban, unchanged from v2); a feature-bullet checklist inside the hero; a colored `border-left`/`border-right` "side-tab" accent on any card (caught by the project's own detector as the single most recognizable AI-slop tell — the video quote panel was fixed to use a large decorative quote glyph instead).

**Key Characteristics:**
- Off-white ground (`--paper`) and near-black ink (`--ink`, never pure `#000`) as the two structural tones
- One locked gold accent, split into two contrast-safe roles (see Colors, this is not two accents, it is one hue used correctly): `--accent` (#ffc200) for fills/icons/large text on dark grounds, `--accent-text` (#815D03) for gold text on light grounds
- A single display type family (Archivo, weights 800–900) for all headings, pushed to a larger editorial scale than the prior pass; Be Vietnam Pro carries every other role
- **Every section owns a distinct layout family** — bento, sticky-scroll stack, manifesto list, split, banner, horizontal carousel, pull-quote — none repeated (unchanged from v2, re-verified after the palette rebuild)
- A layered, purposeful motion system: page-load fade+slide for the hero, a scroll-linked parallax on the hero photo, a slow ambient drift on the hero's mesh-gradient scrim, scroll-triggered fade+slide-with-stagger for section entry, a `position: sticky` panel stack with a real scroll-progress rail for the "4 tư duy" journey, a horizontal scroll-snap carousel for the two browsable lists, and a gold shimmer sweep on primary-button hover

## Colors

Two structural neutrals (ink, paper) plus one accent hue used through two contrast-calibrated roles. Nothing else carries meaning.

### Primary
- **Ink** (#101010): near-black, never pure black. Body text, headings, hero/C.A.R.E/footer backgrounds, default button outline/text-on-gold.
- **Accent — Gold (fill role)** (#ffc200): backgrounds, icon fills, borders, large display text on dark grounds (C.A.R.E letters, hero "TƯ DUY," closing-CTA band). **Never used as text color on a light background** — measured at 1.55:1 against `--paper`, below WCAG AA even at the large-text 3:1 threshold.
- **Accent — Gold (text role)** (#815D03): the same hue, darkened specifically so it passes AA as text on light grounds (5.74:1 against `--paper`, 5.27:1 against `--paper-alt`). Used for the `.hl` heading highlight, pillar/FAQ numerals and icons, and any other gold text sitting on `--paper` or `--paper-alt`.

### Named Rules
**The Two-Gold Rule.** This system has one accent hue, not two accents — but it has two roles, and mixing them up is a contrast bug, not a style choice. Ask "what is gold sitting on, and is it text or a fill?" before picking which token: dark ground → `--accent` is safe for text; light ground → text must be `--accent-text`, fills/icons/borders may still use `--accent`. Button text on a gold fill is always `--ink` (11.75:1), never white (1.62:1, fails AA) and never `--accent-text` (would be nearly invisible on its own hue).

### Neutral
- **Paper** (#FAFAFA): the default page ground.
- **Paper Alt** (#F1F0F0): alternate section background for rhythm — used sparingly.
- **Ink Soft** (#4A4A4A): secondary/muted text (8.49:1 against paper).
- **Ink Faint** (rgba(16,16,16,.12)): hairline dividers and borders, the primary separation device instead of card shadows.
- **White** (#FFFFFF): text on ink or ink-on-white contexts (footer button text, outline-invert hover).
- **Hero mesh tones**: `hero-empty-glow` (#232323, no-banner fallback radial), `hero-mesh-gold` (a soft gold bloom at 22% opacity, positioned away from the text zone), `hero-scrim-black` (the mesh's darkest stop) — components of the hero's layered scrim, not freestanding UI colors.

### Named Rules (continued)
**The Color Consistency Lock.** One accent hue, everywhere, unchanged — see The Two-Gold Rule above for how its two roles are chosen correctly rather than turning it into two accents in practice.
**The Reserved-Strength Exception.** The closing CTA band runs gold at full-bleed coverage (background, not just a button) because it is the page's single most important ask. Text on it is ink (7.87:1) per the button-text rule above.

## Typography

**Display Font:** Archivo (with Be Vietnam Pro, sans-serif fallback) — verified Vietnamese-subset support directly from Google Fonts' served CSS before adoption.
**Body Font:** Be Vietnam Pro (with sans-serif fallback).

**Character:** One confident geometric grotesk for every heading, pushed to a larger editorial scale in this pass (hero title now clamp(2.8rem,6.4vw,4.8rem)/clamp(3.8rem,9.6vw,7.6rem), up from v2's clamp(2.4rem,...)/clamp(3.2rem,...)), paired with a plain, highly legible humanist grotesk for body copy. No handwritten, script, or second display face anywhere.

### Hierarchy
- **Display Hero** (900, clamp(2.8rem,6.4vw,4.8rem) / clamp(3.8rem,9.6vw,7.6rem), 0.92): the hero's "BÓNG ĐÁ" / "TƯ DUY" wordmark.
- **Display** (800, clamp(2.2rem,3.6vw,3.2rem), 1.05): section headings.
- **Display Small** (800, clamp(1.5rem,2.4vw,1.9rem)): FAQ teaser heading.
- **Display accents** (800–900, 1.15rem–4.4rem): C.A.R.E letters, pillar/timeline numerals, closing-CTA heading, club-intro heading — each scaled to its own container, not the page hierarchy.
- **Lead** (600, 18px): tier-card titles.
- **Body** (500, 14.5–16px, 1.7): running copy; near-identical steps across components are intentional, not drift.
- **Label** (600–700, 11–14px, often uppercase): nav, tags, captions, card titles.

### Named Rules
**The One Display Face Rule.** Archivo is the only display/heading face on the page. Mixing in a second display personality is the exact defect two redesigns ago that this system exists to prevent — never reintroduce it.

## Layout

Sections alternate `paper` and `paper-alt` for rhythm, used sparingly. One section (C.A.R.E) and the highlight strip run a solid `ink` background — the system's dark bands. The hero is full-bleed `100dvh`, breaking the container grid; every other section respects `--container-max` / `--section-gap` (120px desktop / 64px mobile — widened this pass for "khoảng trắng cao cấp," premium whitespace).

### Named Rules
**Section-Layout-Repetition Ban (mandatory, carried over from v2 and re-verified after the palette rebuild).** Once a layout family is used for a section, it does not reappear elsewhere on the page:
- **Hero** — full-bleed 3-layer (photo / mesh-gradient scrim / text)
- **Highlight strip** — inline text row divided by hairlines
- **Split** (club intro) — 2-column image/text, now the page's #2 section (see Reality & Business Fit Audit note below)
- **Large centered stage + caption** (video) — a single wide (`1040px` cap, not full-bleed) 16/9 video stage centered in its section, a pull-quote as a centered caption underneath rather than a competing column; the page's #3 section, deliberately smaller than the Hero so no second section ties it for the strongest visual moment (see Components)
- **Sticky-scroll stack** (hành trình) — 4 full-width panels that pin and cover each other on scroll, with a scroll-linked progress rail and a 4-dot step indicator; each panel's active state surfaces its matching pillar icon, a drawn-on-active underline, and its C.A.R.E cross-reference tag (see Components)
- **Manifesto list** (C.A.R.E) — full-width stacked rows on a dark ground, alternating horizontal offset; optionally paired with a sticky 2-column photo rail when Admin has uploaded images (falls back to the original centered 1-column list when they haven't — see Components)
- **Horizontal carousel** (class tiers, activities) — scroll-snap; the one family intentionally reused twice, since both are genuinely browsable lists. Both carousels end in a non-item tile (a consult CTA / a "view all" link) that fills leftover width on wide screens instead of leaving dead space, styled to read as a card, not a decoration
- **Spotlight coverflow** (Vì sao phụ huynh chọn Alpha Kids) — full-bleed 100vw breakout, one testimonial centered and in focus, the previous/next quote peeking at each edge blurred and faded into the page ground, clickable to jump; auto-advances continuously (no manual pause control, a deliberate exception to the reduced-motion default for this signature section) with dot indicators for direct navigation; replaces the earlier flex-wrap proof-point/testimonial grid
- **Boxed Q&A** (Còn thắc mắc về Alpha Kids?) — light-ground band with icon + text head, a full accordion of admin-managed FAQs below it, closing in a "view all" link — not a bare teaser banner
- **Bold Solid Gold Statement** (closing CTA) — full-bleed edge-to-edge (100vw breakout, not container-bound), solid `--accent` fill (the only section on the page that uses gold as a background, not an accent), oversized left-aligned editorial headline — no photo, no card, no glass
**The No-Side-Tab Rule.** A colored `border-left`/`border-right` on a card or panel is banned outright — it is the single most recognizable AI-generated-UI tell. Mark a quote, callout, or emphasis block with a decorative glyph, a background tint, or typographic weight instead.

## Elevation & Depth

Flat by default. No card shadows in the grid components — separation comes from hairline dividers (`ink-faint`). Soft ambient shadows (`--shadow-sm`/`--shadow-md`) are reserved for genuinely floating elements: the sticky header, the mobile menu panel, the video play button. The hero's sense of depth comes from its mesh gradient, not a shadow.

### Named Rules
**The Hairline-Over-Shadow Rule.** Where a bordered-card-with-shadow instinct shows up, use a shared hairline divider inside a flush grid instead.

## Shapes

A small geometric radius scale, no asymmetric "hand-drawn" shapes: `--radius-sm` (8px), `--radius-md` (14px, buttons), `--radius-lg` (20px, photos/cards/video stage, boxed accordion items), `--radius-xl` (28px, the FAQ page's closing "not found your answer" band). The closing CTA is a deliberate exception to the radius scale: full-bleed edge-to-edge with **no** border-radius, since a rounded corner would contradict its "breaks out of the grid" role. `--radius-toast` (10px), `--radius-pill` (999px), and a 2px "legacy chip" radius (mobile-menu close, footer logo) are pre-existing system-utility shapes, unrelated to either world's language. Perfect circles (`50%`) are used freely for icon roundels, the timeline numerals/icon badges, and the timeline dot cluster.

## Components

### Buttons
- **Shape:** simple rounded rectangle (`--radius-md`, 14px), 1.5px border.
- **Primary (`.btn--accent`):** solid gold fill, **ink text** (never white — see The Two-Gold Rule), with a gold "light-catch" shimmer sweep animating across on hover (a diagonal white-tinted gradient translating through, `prefers-reduced-motion`-gated) — the one purely decorative motion in the system, justified as a literal material cue (light catching a metallic surface).
- **Outline (`.btn--outline` / `.btn--outline-invert`):** transparent, ink or white border depending on ground; hover inverts to a solid ink/white fill.
- **This is the one sitewide button style** — header, footer, hero, and every CTA share it.

### Reality & Business Fit Audit — page reorder + section removal
A dedicated audit (not a visual redesign) found the homepage front-loaded pedagogy: two sections back-to-back explained the same 4 "tư duy" pillars (a full-bleed scroll-scrub stage right after Hero, then the sticky-scroll stack "hành trình" later), with zero trust-building content between the Hero and the first pedagogy block, and no way for a parent to find a nearby branch from the homepage at all. Fix, in order of what changed:
1. **Removed the full-bleed scroll-scrub pillars section entirely** (previously the page's #2 section, a `height:420vh` pinned scroll-jack stage — 4 redesigns deep: Swap-in-place Bento → Fixed-list dark → Framed-Photo click-driven → Full-bleed scroll-scrub). Kept the sticky-scroll stack ("Sticky-scroll stack" family, still the page's #4 section) as the sole presentation of the 4 pillars — it's the cheaper mechanism (pure CSS `position:sticky` stacking, no custom scroll-jack math) and removing the earlier, longer, more front-loaded duplicate does more to fix the pacing problem than removing the later one would.
2. **Moved "Split" (club intro)** from #3 to #2 — trust content (a real club, real people) now comes immediately after the Hero/highlight strip, before any pedagogy section.
3. **Moved and redesigned the video section** from #6 to #3, right after club intro — see Components below. Two trust-building sections (club intro + video) now sit back-to-back before the page turns to pedagogy (pillars journey, C.A.R.E).
4. **Added a branch-finder link** to club intro (`.club-intro__branch-link`, "Xem cơ sở gần bạn") pointing at `route('branch.index')` — a light-touch fix for parents having no way to check branch proximity from the homepage; deliberately a text link, not a second button, so it doesn't compete with the section's primary CTA.

### Large Centered Stage + Caption (video)
Replaced the previous 2-column bento (video fighting a pull-quote column for width) — then redesigned from a light-ground/two-headline version (an `<h2>` plus a same-weight pull-quote stacked above the stage, read as two competing headlines) into a single-voice hierarchy, then redesigned that hierarchy's *roles* once more (see Redesign 5 below). The stage fills a centered column inside the normal `.container` — deliberately **not** full-bleed like the Hero or closing CTA (a second section tied with the Hero for strongest visual moment would flatten the hierarchy, and would reuse the full-bleed family a third time — see Section-Layout-Repetition Ban). Grew from 1040px to **1280px** on request for more presence, still short of `--container-max` (1500px).

**What the background tried and rejected before landing.** Two earlier passes at giving the flat `--ink` background some depth were both built, verified, and then rejected on taste grounds, not technical grounds:
- **Vector accent shapes** (a solid gold corner shard + a hairline ring breaking the stage's corners) — correct in isolation but tonally wrong: the brand's whole video argument is "real footage, not description," and a CSS-drawn accent shape is exactly the graphic device that argument exists to avoid.
- **A photographic section background** (`bg-section-video.png`, a heavily blurred stadium-floodlights-at-night bokeh photo, bright clusters at the far edges, center column near-black) — measured and verified (contrast ratios ~20.8:1 / ~10.6:1 against WCAG's 4.5:1/7:1, re-checked at 1400px and 1920px) but still rejected: felt heavy as a whole-section treatment and cut abruptly against the light section that follows.

**Redesign 4 — the split section, current.** Back to flat color (no image, no vector decoration — the restrained material this system actually speaks), but the `--ink` fill no longer covers the whole section. `.intro-video-section__dark-bg` is an absolutely-positioned overlay from the section's top, its `height` driven entirely by a JS-measured CSS custom property (`--video-split-height`), not a guessed percentage: `initVideoSplit()` (`home.js`) measures the video stage's real rendered top offset and height and sets the split to *stage-top + stage-height × 2/3* — i.e. the boundary always falls exactly two-thirds down the video card itself, regardless of how many lines the eyebrow/statement text wraps to at a given viewport width (a quantity no fixed CSS percentage could predict). Below that line the section is plain `--paper` — and because A4 (the pillars sticky-scroll stack right after) is also `--paper`, the boundary between the two sections disappears entirely; only a dark band floats over the video's top two-thirds, not a full dark block. `.intro-video__caption`, which now always lands in the white zone, switched from dimmed white to `--ink-soft`.

The measurement has one real timing hazard, caught and fixed by testing rather than assumed correct: `.intro-video-feature` carries `.reveal`, which holds it at `translateY(32px)` until scrolled into view. A naive single measurement on `DOMContentLoaded` captures that pre-reveal offset and freezes the split ~25px too low — reproduced and confirmed via a scripted check before the fix. The fix listens for the reveal's own `transitionend` (the precise moment the offset settles) plus a `scroll` listener as a self-healing fallback, rather than a fixed delay guess.

**Play button — tried a custom one, then removed it for native controls.** The stage originally had a hand-drawn gold circle button (`.intro-video__play`) that JS swapped for an iframe/`<video>` on click. Its first shadow (`--shadow-md`, `rgba(16,16,16,.12)`) was calibrated for light-ground cards and composited into a barely-visible muddy ring on the `#232323` stage — reported back as "xấu" (ugly), confirmed from a screenshot, and fixed with a dark lift-shadow plus a gold ambient glow tuned for a dark ground. That fix shipped, then the user asked to drop the custom button entirely and use the platform's own default control instead. `.intro-video__play`, its shadow work, and `initIntroVideo()` (the click-handler that injected the iframe/`<video>`) are gone. The media element now renders directly server-side: `<video controls poster="...">` for upload mode (the browser draws its own native play button, scrubber, and volume/fullscreen controls — nothing left to style or fix), and a plain `<iframe>` (no `autoplay` param) for YouTube mode, which shows YouTube's own thumbnail and play chrome. `.intro-video__stage` keeps its frame (border, radius, `#232323` fallback background) but dropped `cursor: pointer` — the frame isn't a click target anymore, only the native controls are.

**Play hint overlay — augmenting native controls, not replacing them again.** In real use the user reported not seeing a play button at all. A Playwright screenshot of the live page (matched against a screenshot the user sent from their own browser) confirmed the native control bar was in fact rendering correctly — the issue was legibility, not function: Chrome's own play glyph is a small triangle in the bottom-left of the control strip, easy to lose against a busy poster image (the current thumbnail is a bold "FOOTBALL HIGHLIGHT" graphic). `.intro-video__play-hint` adds a large (76px) semi-transparent dark circle with a white play triangle, centered on the stage, purely as a discoverability affordance — it does not reimplement playback: clicking it just calls `video.play()` (`initVideoPlayHint()`, `home.js`), and it listens to the real `play`/`pause` events on `#introVideoEl` to hide/reappear, so it also correctly disappears if the user starts playback via the native control bar directly rather than the hint. This is not a reversal of the earlier "native controls only" decision — the native `<video controls>` bar is untouched and still does all the actual control work; the hint is a thin visibility layer on top, scoped to the upload path only (YouTube's `<iframe>` already shows its own large red play button by default, so no hint is added there).

**Admin-configurable thumbnail (`home_video_thumbnail`).** Only meaningful for the upload path, since a `<video poster>` is what the thumbnail feeds — YouTube supplies its own thumbnail and has no external-poster hook. Lives in the "Video" tab now, not the generic "Hình ảnh" grid: it's edited alongside `video_mode`/`video_youtube_url`/`video_file` through the same form and `updateVideo()` action (`VideoSettingRequest` gained a `video_thumbnail` image rule; the controller stores/deletes it independently of which `video_mode` is active, so switching modes doesn't lose a previously-uploaded thumbnail). This was also the real fix for the play button reading as "alone in a void" one redesign earlier: an admin with nothing configured saw a lone circle floating in a flat `#232323` rectangle with nothing to anchor it — now that same empty rectangle is filled by a real poster frame from the moment the page loads, no JS or click required.

**Redesign 5 — the text hierarchy's roles, swapped.** Every redesign up to this point kept "Học mà chơi, chơi mà học." (the club's philosophy tagline) as the large, primary text and "Một ngày học tại Alpha Kids" as a small 11px uppercase eyebrow label above it. The user asked for the opposite, and the reasoning holds up on inspection, not just preference: "Một ngày học tại Alpha Kids" states plainly what the section/video is about — it's doing a heading's actual job — while the tagline is a mood line better suited to a supporting role underneath a clear heading than to carrying the section alone. `.intro-video__eyebrow` and `.intro-video__statement` (the bespoke classes this section had carried through 4 straight redesigns, the one place on the page with its own one-off text treatment) are gone. In their place: a plain `<h2><span class="hl">…</span></h2>` + `<p>`, the exact structure every other section-head on the page already uses — `.intro-video__lead h2` and `.intro-video__lead p` are written to literally match `.hp-section--ink .section-head h2`/`p`'s values (`clamp(2.2rem,3.6vw,3.2rem)`/800 weight for the heading, `16px`/`rgba(255,255,255,.7)` for the subtext) rather than a new scale, and `.intro-video__lead .hl` matches `.hp-section--ink .hl`'s `--accent` override. The section still doesn't carry the `hp-section--ink` class itself (its background is the partial split-overlay, not a full ink fill), so these values are restated locally rather than inherited — but restated as exact matches, not near-misses, so the section finally reads as *the same kind of heading* as Club Intro, C.A.R.E, and the pillars journey instead of a one-off.

### Manifesto List (C.A.R.E)
Full-width stacked rows on the `ink` dark band, each a giant `--accent` (bright gold, safe on dark) letter beside its name and Vietnamese gloss, divided by hairlines. Even rows carry a small `translateX` offset resolving to 0 on scroll-reveal. **Photo rail:** when Admin uploads `home_care_photo_1`/`_2`, the section becomes a 2-column layout (`:has(.care__photos)`), list on the left, a sticky stacked photo rail on the right filling what was previously bare `ink` background on wide screens; with no photos it stays the original centered 1-column list. Never both column layouts fighting for the same width — the `:has()` selector switches cleanly between them.

### Horizontal Carousel (class tiers, activities)
`display:flex; overflow-x:auto; scroll-snap-type:x proximity`, cards sized to intentionally show a "peek" of the next card on mobile. Native scroll, no JS scroll-hijacking. Each carousel ends in a non-item tile that fills leftover row width on wide screens: `.tier-card--consult` (a dark "chưa chắc chọn lớp nào?" CTA card) and `.activity-card--more` (a dashed "xem tất cả" link card) — both are real navigation, not decorative filler. Class tier cards also carry a 3-point `.tier-card__focus` bullet list grounded in the confirmed 4-tư-duy/C.A.R.E framework, replacing the old single generic sentence.

### Flexible Proof Grid (Vì sao phụ huynh chọn Alpha Kids)
Replaces the old bare testimonials placeholder. Backed by the `ProofPoint` model (Admin CRUD at "Vì sao chọn Alpha Kids"): `title`, `description`, optional `author_name`/`author_role`, optional `icon`, `sort_order`, `is_active`. Rendering branches on one field — `ProofPoint::isTestimonial()` (true when `author_name` is filled): a plain point renders as a compact icon+title+description card (`.proof-card`); a testimonial renders as a wider quote card (`.proof-card--quote`, `flex-basis: 380px` vs. 260px) with a large gold quote glyph, dark ground, and attribution — the same `flex-wrap` grid holds both without a template change. Ships seeded with 4 confirmed-fact proof points (multi-branch, C.A.R.E, age-tiered curriculum, free-trial policy) so the section is never empty; Admin replaces them with real parent testimonials over time by editing the same records and filling in a name.

### Accordion (Q&A) — shared primitive
One implementation (`base.css` + `initAccordions()` in `app.js`, loaded site-wide) backs both the full `/cau-hoi-thuong-gap` page and the homepage's "Còn thắc mắc về Alpha Kids?" section — same markup contract (`[data-accordion]` wrapping `.accordion-item` rows, each a `button[data-accordion-trigger]` + sibling `[data-accordion-panel]`), same motion. Bung/thu uses `grid-template-rows: 0fr → 1fr` (no JS height measurement); the trigger icon is a plain CSS-drawn plus/minus (two pseudo-element bars, the vertical one rotates 90° into the horizontal one — never a chevron sprite, no icon font). Each `[data-accordion]` container allows exactly one open item at a time (`initAccordions()` closes siblings on click); the first item renders `aria-expanded="true"` server-side on both surfaces so the block is never empty on load. `.accordion--boxed` is the only modifier in use: each question becomes its own bordered, rounded card (`--radius-lg`, hairline border — Hairline-Over-Shadow Rule, no shadow) with spacing between cards instead of a flush hairline-divided list; the open card's background switches to `--accent-soft` via `:has(.accordion-item__trigger[aria-expanded="true"])` — pure CSS, no extra JS class. Backed by a single `Faq` model (Admin CRUD at "Câu hỏi thường gặp"): `question`, `answer`, `sort_order`, `is_active`, `show_on_home` — `show_on_home` controls whether a question also surfaces on the homepage section, independent of its "Hiển thị" (`is_active`) status on the full FAQ page.

### Navigation
Uppercase, bold, small (11.5px) labels; active item gets a gold underline. Transparent (home hero) header variant renders white text for legibility against the scrim; the solid variant uses ink on the light background.

**Transparent header — fixed with its own scrim, not absolute riding on the hero's.** Two real, verified problems in the original implementation, not aesthetic guesses: (1) `.site-header--transparent` was `position: absolute`, which scrolls away with the hero — a Playwright check confirmed the header fully off-screen (`top: -1200px`) after scrolling one viewport, meaning the entire rest of the (long) homepage had zero navigation, no way back to any page or the CTA without scrolling back to the very top; (2) the header's white nav text had no contrast guarantee of its own — it was riding on `.hero__photo-overlay`, a scrim shaped for the hero's *own* text zone (bottom-left), which deliberately leaves the top-right unshaded for the gold mesh glow — exactly where four of seven nav items and the CTA sit, so legibility depended on the luck of whatever the hero photo's top-right corner happened to show. Fixed by giving `.site-header--transparent` `position: fixed` (stays pinned through the whole scroll, same as `--solid` already did via `sticky`) plus its own `::before` gradient scrim (180px, independent of the hero's), and adding an `.is-scrolled` state — toggled by `initHeaderScroll()` in `app.js` (one rAF-throttled `scroll` listener, `window.scrollY > 48`, site-wide script since the header partial is shared) — that switches the header to the exact same look `--solid` already uses (`--color-bg` background, `--shadow-sm`, ink text), not a third visual language. The interior pages' `--solid` variant (`position: sticky`) was left untouched — it already had neither problem. Verified end-to-end on the live site: nav stays legible against a deliberately bright sky patch stress-tested in the Artifact preview first, and the header is still pinned and readable four sections deep into the homepage (checked at the C.A.R.E section).

### Signature Component: Sticky-Scroll Timeline
Four full-width panels each `position: sticky` at the same header-offset `top`, later panels covering earlier ones as the user scrolls (pure CSS for the pin). `home.js` computes real scroll progress via one rAF-throttled listener, writing a `--progress` custom property (set on `#timelineStack` so descendants inherit it) that drives a vertical rail's `scaleY` fill; each panel gets `is-active` (numeral brightens to `--accent-text`) once its `getBoundingClientRect().top` crosses an activation line set at `1/3` of viewport height — i.e. the instant the panel scrolls into the bottom two-thirds of the viewport, well before it visually pins at the header offset. This threshold moved earlier through three rounds of user feedback (originally a global-linear progress across the whole 4-panel stack, then panel-pin-position, then 2/3 viewport, settled at 1/3 viewport) because the rail visually lagging behind the panel the user was already reading felt broken. The rail fill transitions (`transform .5s`) between the four discrete steps rather than snapping, since progress no longer changes continuously.

**Active-state enrichment.** Five devices carry the panel from a bare numeral+text into something with real information depth, all cross-referencing content already established in the Pillars section above it rather than inventing anything new: (1) each panel's icon is the exact SVG used by its matching pillar tile, dim by default and lifting to an `--accent-soft` roundel when active; (2) a 2px underline draws in from `width: 0` to `64px` on activation (`transition: width`), a "being written" cue rather than a flat color swap; (3) each panel carries its pillar's C.A.R.E cross-reference tag (e.g. "Ask & Answer"); (4) a 4-dot progress cluster (`#timelineDots`) sits `position: sticky; top: 50vh` on the rail throughout the whole scroll range, filling gold in step with the same `activeCount` the JS already computes for panel `is-active` — no separate calculation, hidden below 768px to avoid rail crowding on narrow screens; (5) an anchored photo column (`.timeline-panel__media`) on the right, described below.

**Anchored photo column.** The right side of each panel originally carried only a small (220×220px) square photo pushed to the far edge by `margin-left: auto`, leaving a wide dead gap next to the (`max-width: 34ch`) text column — read as empty rather than intentional. Redesigned right-side-only (left side — number, icon, heading, underline, paragraph, tag — deliberately untouched, per explicit instruction) after a written Interactive Design Pitch and a Claude Artifact preview approved by the user: the photo is now wrapped in `.timeline-panel__media`, resized to a portrait `280px` / `aspect-ratio: 4/5` `.timeline-panel__visual` with a `1px solid var(--ink-faint)` hairline border (matching every other framed photo on the site) that shifts to `var(--accent)` on `.is-active`, plus a small `.timeline-panel__folio` caption ("01 / 04" through "04 / 04", reusing the site's editorial-numbering convention) that shifts to `--accent-text` on `.is-active` — giving the photo the same activation-state color response the icon, underline, and numeral already had. Falls back to the `:not(:has(.timeline-panel__media))` selector (widening the paragraph to `60ch`) when no Admin photo is configured for that panel, and hides below 1100px alongside the rest of the media query.

### Signature Component: Hero Mesh Gradient
The hero's scrim layer is not a flat linear gradient: it layers two radial gradients (a soft gold bloom at the top-right, away from the text zone; a strong black radial anchored bottom-left, under the text) under the base linear gradient, then drifts the whole composite a few percent over 22 seconds (`background-position` animation, ease-in-out, alternating) to suggest stadium floodlight movement. Disabled entirely under `prefers-reduced-motion`. Contrast for the text zone is verified independent of the drift — the darkest stop never moves into the text's safe zone in a way that would reduce contrast below the mesh's resting state.

### Signature Component: Closing CTA — dark full-bleed statement, shared across pages
Corrected against the actual current implementation (this entry previously described an earlier gold-background iteration that no longer matches the code — see history below). `.closing-cta` is a full-bleed `100vw` breakout (`margin-left: calc(50% - 50vw)`), `--ink` background, an optional Admin-uploaded `.closing-cta__photo` under a flat `rgba(16,16,16,.637)` `.closing-cta__scrim`, white headline (`display-letter` type step, `clamp(2.8rem,5.4vw,4.4rem)`), gold-accented span via `.text-accent-free`, and a gold `.btn--accent` primary action. Never depends on the photo being configured — falls back to the flat `--ink` field, so it can never render half-finished. Moved from `home.css` into `base.css` (with `.text-accent-free` and `.closing-cta__actions`, a new class for a 2-button layout) when the About page needed the exact same component with different copy and a second (`.btn--outline-invert`) button — it is now a shared, site-wide primitive rather than a homepage-only one. (A prior pass documented here described a solid-gold-background version with `--ink` text, rejected at the time as "Glass-on-Mesh" for repeating the Hero's dark/photo/scrim recipe — the code found in this pass no longer matches that description; corrected to reflect what actually ships today rather than guess at the undocumented intermediate change.)

### Hero (3-layer contract, max-4-element stack)
Exactly 3 layers: (1) full-bleed photo, `min-height: 100dvh`, with scroll-linked parallax; (2) the mesh-gradient scrim described above; (3) text/CTA, fade+slide-in on page load. The text layer holds at most 4 elements (eyebrow mark, headline, subtext, CTA row) — a feature checklist does not belong in the hero; it lives in the highlight strip directly below.

### Highlight Strip
A thin `ink` band directly under the hero carrying the former hero checklist as 4 short phrases in one row (2×2 on mobile), divided by hairlines, no icons, no bullets, no card chrome.

## Page: Về CLB (About)
First non-homepage page built out (previously a stub: bare `.section` + `<h1>`). Content came from a reference mockup the user supplied — carried over verbatim (headings, copy, the 5 core values, the 6 stat labels), explicitly *not* its purple-card visual language; every section is built from primitives already established on the homepage rather than a new visual world, per an approved Interactive Design Pitch + Artifact preview (iterated once: the banner was first built as a 2-column text/photo split, then corrected to be a literal clone of `.faq-hero`'s size and centered layout with a wide photo band below it instead, per explicit feedback that it should match the FAQ page's banner "y đúc" — exactly).

- **Banner (`.page-hero`)** — shared, full-bleed (`100vw` / `margin-left: calc(50% - 50vw)`, same breakout as `.closing-cta`) section used by every non-homepage page. What started as `.about-hero` and `.faq-hero` — two separate declarations with identical values — was consolidated into this one class in `base.css` (moved out of `faq.css`/`about.css`). The homepage's own Hero is intentionally excluded — full-bleed 3-layer photo/scrim/text at `100dvh`, a different, larger component this one doesn't try to replicate.
  - **Two states, one class.** No Admin photo configured (FAQ today) → flat `--paper-alt`, `--ink` text, exactly the original `.faq-hero` look. Photo configured (`.page-hero--photo` modifier, About today) → `.page-hero__photo` (`position:absolute; inset:0`, `object-fit:cover`) fills the section as a background, `.page-hero__scrim` (`rgba(16,16,16,.6)`, flat) sits above it, and the text (`.container`, `z-index:2`) sits above both — photo → scrim → text, matching the same layer order as the Hero and Closing CTA rather than inventing a fourth pattern. Text flips to white/`--accent` under `--photo` (Two-Gold Rule for the `.hl` span).
  - **Banner photo went through three shapes before this one** — each a real, distinct mistake, not taste-polishing: (1) a *contained*-width `21/8` box placed **after** the text (not behind it) — at ~1216px container width that rendered ~490px tall, nearly tripling the banner's height versus FAQ's; reversed as not "y đúc." (2) A corrected-height full-bleed version, still placed **after** the text as a separate stacked block below it (fixed `height: clamp(220px, 30vw, 380px)` instead of a width-driven aspect-ratio — a real fix, kept in the final version) — but the photo sitting *after* the copy rather than *behind* it as its backdrop was itself the actual, different request; reversed again. (3) Current: same fixed-height photo, but layered as background + scrim + overlaid text within the same `.page-hero`, no longer a second stacked block.
  - **Shared going forward, not About-only.** `method`, `program`, `activity`, `branch`, `parent`, and `registration` already carry their own `{page}_banner` key in `OtherPagesImageGroups` (added before this page existed, unused until now) — each can adopt `.page-hero` + `.page-hero--photo` with zero new CSS when built out.
- **Giới thiệu, gộp vào Tầm nhìn/Sứ mệnh.** Originally its own `.section` — a heading plus one paragraph floating alone in a large white section, nothing else anchoring it, sitting right below a banner making a near-identical claim. Reported back as reading unfinished, not just under-styled. Fixed by merging it into the Tầm nhìn/Sứ mệnh section as that section's `.section-head--center` lead-in, on the same `--paper-alt` ground — one chapter ("who Alpha Kids is / what it believes") instead of two thin, disconnected scroll-stops.
- **Tầm nhìn / Sứ mệnh** — 2 bordered cards (hairline, no shadow — Hairline-Over-Shadow Rule), each an icon roundel (`--accent-soft` fill, `--accent-text` stroke — the light-ground-safe pairing) + heading + a drawn `.value-pair__rule` + copy. Content is fixed (not Admin-editable), matching the precedent already set by the homepage's C.A.R.E principles, which are hardcoded in `home.blade.php` rather than database-driven.
- **Giá trị cốt lõi — redesigned once, not just restyled.** The original 5-across icon grid (`.core-values`, now gone) was flagged as a generic pattern with small, hard-to-scan text. First replacement attempt was a single-column list of full-width rows with a leading `01–05` numeral — this introduced two real defects: (1) `flex-wrap` let each row's heading/description wrap independently, so headings didn't line up between rows ("chữ nhảy lung tung" — reported directly); (2) the numbering implied a sequence that doesn't exist — the five values are parallel, not ordered steps, which the project's own numbering guidance says not to imply. Final version (`.value-rows`, `.value-row`) drops the numeral entirely, uses a fixed 2-column grid (not flex-wrap) so headings always land on the same baseline, and matches the column width used by the Tầm nhìn/Sứ mệnh cards directly above it rather than an arbitrary narrower measure. Five items in two columns leaves one orphan in the last row; rather than let it sit alone in column 1 with a dead gap beside it, `.value-row:last-child` spans both columns and centers itself at exactly one column's width (`max-width: calc(50% - 24px)`) with a stacked (icon-above-text) treatment, reading as a deliberate closing item instead of a broken grid cell.
- **Đôi lời tâm sự — replaced the stat block entirely, not just restyled it.** The original "Alpha Kids hiện nay" stat block (photo + 2×3 number tiles) sat directly after the icon-heavy "Giá trị cốt lõi" bento grid — two consecutive "structured tile" sections back to back, both reading as data blocks. Client feedback asked for something personal instead: a short first-person message from a coach representing the club, photo of the person + name/role caption on the left, the letter itself on the right. Kept `.section--alt` (unchanged rhythm — Closing CTA remains the page's one `--ink` section). Layout is deliberately narrower than the rest of the page (`.letter-block`, `max-width: 900px`, centered) rather than stretching to `--container-max` — an intimate single-voice message reads as a data block if it fills the full width the tile grid used. No card chrome (no border, no icon roundel) as a deliberate contrast against the bordered-card language used everywhere else on this page: after a grid of 5 bordered tiles, the page needed a moment without boxes before the bold `--ink` Closing CTA. Typography leans on a classic drop cap (`::first-letter` on the opening paragraph, sized in the existing "Display accents" range) instead of a quote-glyph, since the homepage's own Proof section already owns the quote-glyph motif — reusing it here would read as the same component copy-pasted across pages. Closes with `.letter-body__rule`, the exact `.value-pair__rule` accent-rule treatment from the Tầm nhìn/Sứ mệnh cards above it, reused rather than inventing a new "how a block ends" device. Content is 3 `Setting` key/values (`about_letter_name`, `about_letter_role`, `about_letter_message`) editable from the "Về CLB" tab in Cài đặt → Nội dung trang khác, plus `about_letter_photo` in `OtherPagesImageGroups`; no message configured → honest dashed-hairline empty state (`.letter-empty`), never a fabricated quote (Do's rule). `about.js` and its `initCountUp()` were removed outright, not just unused in markup — the stat block was its only caller.
- **Motion, added in this pass.** `data-reveal-group` + `.reveal`/`.reveal-d1`..`.reveal-d5` on every section (fade+slide, staggered) — the same mechanism the homepage already had, but `initRevealOnScroll()` lived only in `home.js` until now. Moved to `app.js` (site-wide) since About needed it too; `.reveal`/`.is-inview`/`.reveal-d1`–`.reveal-d4` moved from `home.css` to `base.css` alongside it (added `.reveal-d5` for the 5-item value list), `home.js`'s own call and definition removed to avoid running the observer twice. Stat numbers count up from 0 on scroll-into-view (`about.js`, `initCountUp()`, easeOutExpo, fires once per page load). Neither this nor the reveal system gates on `prefers-reduced-motion` — a standing site-wide rule (the user's own OS has it set to reduce, and accessibility-respecting fallbacks on this project have repeatedly read as "broken," not as an accommodation).
- **Closing CTA** — the shared `.closing-cta` component (see Signature Components), reused verbatim with page-specific copy and a second button (`.btn--outline-invert`, already existed for dark-ground secondary actions — see Hero). Now the page's only `--ink` section. Gained an optional Admin background photo (`about_closing_cta_photo`, new "CTA cuối trang" group in `OtherPagesImageGroups`) mirroring the homepage's `home_closing_cta_photo` exactly — same `.closing-cta__photo` (`position:absolute; inset:0; object-fit:cover`) → `.closing-cta__scrim` (flat `rgba(16,16,16,.635)`) → text layer order already defined in `base.css`, so no new CSS was needed, only the `<img>` conditional in the blade and the Setting plumbing. No photo configured → falls back to the flat `--ink` field exactly as before.
- **Shared-primitive extraction.** Building this page surfaced that `.section-head`, `.section-head--center`, `.hl`, and `.closing-cta` (+ children, `.text-accent-free`) were homepage-only by accident of file location, not by design — they carried no actual homepage-specific logic. Moved to `base.css` as `.section`/`.section--alt`/`.section--ink` + the above (home.css keeps only its own `.hp-section` wrapper and the `.hp-section--ink` overrides for `.hl`/`.section-head`, which still apply since they target the same now-shared class names). About's own `about.css` holds only what's genuinely page-specific: `.value-pair`, `.value-rows`/`.value-row`, `.letter-block`/`.letter-empty` and children.

## Page: Phương pháp (Method)

Second non-homepage page built out from a stub. Content and structure came from a reference mockup the user supplied (banner, 2-card intro, 4-card C.A.R.E breakdown, 4-step pillar summary, a photo+values closing banner, CTA), carried over verbatim — explicitly *not* its purple-gradient, per-letter-rainbow visual language, following the same approach set by the About page: build from primitives already established, single accent hue throughout.

- **Banner, C.A.R.E cards, and closing banner reuse `OtherPagesImageGroups` keys that already existed** (`method_banner`, `method_care_celebrate`/`ask_answer`/`repetition`/`enjoy_strict`, `method_heart_banner`) before this page had any real content — added ahead of time when the About page's image-group scaffolding was built out. All copy is fixed in the blade, not Admin-editable, matching the precedent already set for Tầm nhìn/Sứ mệnh and C.A.R.E on other pages.
- **`.value-pair`/`.icon-roundel`/`.value-pair__rule` moved from `about.css` to `base.css`.** Reusing `.value-pair` for the "Nền tảng phương pháp" cards assumed it was already a shared primitive like `.page-hero`/`.closing-cta` — it wasn't; it had only ever lived in `about.css`, page-scoped. Method doesn't load `about.css`, so `.icon-roundel svg` had zero CSS applied on this page, and the bare `<svg>` fell back to the browser's default replaced-element size (300×150), rendering as a giant icon overlapping the card text. Moved the whole block to `base.css` (About's `.value-card`/`.value-bento` overrides of `.icon-roundel` for the featured/alt variants stay in `about.css`, unaffected — specificity still wins regardless of which file a rule lives in). The same class of bug the earlier "Shared-primitive extraction" pass on About was meant to prevent going forward; missed here because the reuse wasn't re-verified against which file the class actually lived in before shipping.
- **Banner** — `.page-hero`/`.page-hero--photo`, reused verbatim from About/FAQ, new copy only.
- **"Nền tảng phương pháp" (2 cards)** — reuses `.value-pair` verbatim (same component as Tầm nhìn/Sứ mệnh on About).
- **"Phương pháp huấn luyện C.A.R.E" (4 detail cards) — new `.care-detail-grid`, not a reskin of the homepage's C.A.R.E list.** The homepage's `.care-row` is a bare list (letter + heading, no photo); this page needed more depth (subtitle, longer copy, a representative photo per letter), so it's a genuinely different component rather than the same one restyled. Letter badge (`.care-detail-card__letter`) is a single flat `--accent` circle, not the mockup's red/blue/green/orange per-letter palette — one accent hue holds regardless of how many items are being distinguished (numbering/position does that job, not color). Card order is letter + heading + subtitle + description first, photo last — matching the mockup's own hierarchy (identity and explanation before the supporting photo); an earlier draft inverted this (photo first) and buried the letter identity below an anonymous image, corrected after review.
- **"Mô hình 4 tư duy" (4-step summary) — new `.pillar-strip`, deliberately not a second sticky-scroll stack.** Same 4 pillars as the homepage's scroll-driven Timeline (Giao tiếp/Đánh giá/Ứng xử/Lãnh đạo), but a quick static reference here (icon + number + heading + one line), not a competing full experience. Numbered `01`–`04` with connecting arrows is intentional, not an accidental sequence-implication: the homepage's own copy already frames these 4 as an ordered journey ("nối tiếp nhau như một đường chuyền có chủ đích"), unlike the About page's 5 core values, which are parallel and were corrected to drop implied numbering for exactly that reason.
- **"Giáo dục bằng trái tim, huấn luyện bằng tri thức" — contained rounded banner, not full-bleed.** Repeats the same 5 core-value icons already detailed on the About page, by the client's explicit choice to keep the closing restatement rather than cut or trim it. Built as `.heart-banner` — a bordered/rounded panel sitting inside the container with a photo on one side, not the `100vw` full-bleed treatment the mockup and the Closing CTA both use. This was a deliberate anti-repetition call: a full-bleed `--ink` band here would sit directly above the Closing CTA's own full-bleed `--ink` band, the exact "two dark sections back to back" defect already caught and fixed once on the About page. Keeping this one contained preserves the Closing CTA as the page's one true full-bleed dark beat.
- **Closing CTA** — `.closing-cta` reused verbatim with page-specific copy, no background photo (no `method_closing_cta_photo` key exists — falls back to flat `--ink`, the component's existing no-photo state, not a gap).

## Do's and Don'ts

### Do:
- **Do** check which ground gold sits on before choosing the token — `--accent` for fills/dark-ground text, `--accent-text` for light-ground text (The Two-Gold Rule).
- **Do** use ink text on every gold-filled button and band — never white, never accent-text-on-accent.
- **Do** use numbering/icon, never color, to distinguish items within a "four things" or "three things" grid.
- **Do** keep the hero's scrim strong enough to hold WCAG AA regardless of the uploaded photo's brightness, including at every point of the mesh's drift animation.
- **Do** ship honest empty/no-content states (dashed hairline outline + plain sentence) — never fabricated testimonials, stats, or FAQ content.

### Don't:
- **Don't** introduce a second display/heading font, handwritten or otherwise.
- **Don't** add a second accent hue, even a tint, for a "just this one section" reason.
- **Don't** put white text on a gold fill, or `--accent`-on-paper text — both fail WCAG AA; this has been measured, not eyeballed.
- **Don't** add a colored `border-left`/`border-right` "side-tab" to any card or panel — mark emphasis with a glyph, tint, or weight instead.
- **Don't** add card borders + shadows back onto the flush hairline grids.
- **Don't** repeat a layout family across sections — check the Section-Layout-Repetition list before adding a new "N items in a row" section.
- **Don't** put a feature checklist, trust strip, or pricing teaser inside the hero.
- **Don't** use an em dash (—) anywhere in new copy. Use a comma, period, or colon instead.
