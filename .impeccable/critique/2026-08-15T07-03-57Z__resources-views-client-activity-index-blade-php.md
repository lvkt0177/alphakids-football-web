---
target: resources/views/client/activity/index.blade.php
total_score: 22
max_score: 32
na_heuristics: 5,10
p0_count: 1
p1_count: 2
timestamp: 2026-08-15T07-03-57Z
slug: resources-views-client-activity-index-blade-php
---
**Method: dual-agent (A: aa7744f75770137ce · B: af8970a277f5fcf3a)**

## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 2 | Filter chip click changes off-screen content with no scroll/feedback cue; only pillar's "Xem các kỳ đã qua" scrolls |
| 2 | Match System/Real World | 2 | Chips appear before the copy that explains what the 3 categories mean |
| 3 | User Control & Freedom | 3 | "Tất cả" resets cleanly |
| 4 | Consistency & Standards | 4 | .activity-card/.icon-roundel/.page-hero/.closing-cta reused verbatim |
| 5 | Error Prevention | n/a | No form on page |
| 6 | Recognition > Recall | 3 | Icon+label pairing consistent across chip/pillar/tag |
| 7 | Flexibility & Efficiency | 2 | No query-param filter state, no deep link |
| 8 | Aesthetic & Minimalist | 2 | 3 separate UI surfaces all do category-selection |
| 9 | Error Recovery | 4 | Empty state explicitly tells user to click "Tất cả" |
| 10 | Help & Documentation | n/a | Persuade-mode marketing page |
| **Total** | | **22/32** | **Acceptable (69%)** |

## Design Specificity Verdict

LLM assessment: skin is bespoke (icon-only category distinction, honest empty states, tuned -56px hero overlap), but the IA (floating filter bar + pillar CTA filter + archive toolbar filter, 3 surfaces for 1 job) is generic events-page scaffolding not derived from this page's actual 3-category, partially-empty data model.

Deterministic scan: clean on both index.blade.php and activity.css (exit 0, 0 findings), but .blade.php extension routed the scan through the lighter regex engine, not full HTML/DOM analysis, and did not auto-follow linked CSS.

Visual overlays: unavailable, no browser tool in this environment.

## Overall Impression

Not technically broken, but a real IA duplication problem: 3 UI surfaces (floating filter bar, pillar CTA, archive toolbar) all do "pick a category" for a data model with only 3 categories. Plus one confirmed CSS bug making the "Sắp ra mắt" pillar card look broken.

## What's Working

- Empty-state honesty: no fabricated content in "Sắp ra mắt" cards
- Filter bar's -56px overlap is calculated against .page-hero's own padding, not a magic number
- Consistent reuse of .activity-card/.icon-roundel/.closing-cta across pages

## Priority Issues

[P0] Coming-soon pillar card leaves large dead space - CONFIRMED by direct code inspection: .pillar-grid is display:grid with default align-items:stretch, so all 3 cells match the tallest (the live card with image+foot). Only the live branch has .pillar-card__foot{margin-top:auto}; the "Sắp ra mắt" branch's .badge-soon has no bottom anchor, so content stacks at top leaving a large void below. Fix: give the coming-soon branch its own margin-top:auto. Suggested command: /impeccable layout

[P1] Redundant/premature category chrome - floating filter bar precedes the Pillar Spotlight copy that explains the categories, and duplicates pillar CTA filtering. Suggested command: /impeccable layout

[P1] Filter chip clicks lack feedback - verified in activity.js: only goto-category buttons call scrollIntoView; standalone filter chips silently mutate off-screen content. Suggested command: /impeccable clarify

[P2] No filter deep-linking / URL state. Suggested command: /impeccable harden

[P3] Gallery strip photo overlap with archive grid above it, diluting the intended visual peak before the closing CTA. Suggested command: /impeccable distill

## Persona Red Flags

Jordan (first-timer): sees 4 unfamiliar icon chips before any explanation of what they mean.
Casey (mobile): filter bar scrolls horizontally with no fade/arrow cue, 4th chip may go undiscovered; chip tap shows no visible change onscreen.
Riley (stress-tester): mobile single-column pillar-grid makes the P0 dead-space bug even more visually obvious.

## Minor Observations

- pillar-card--live vs plain differs only by paper vs white background, a subtle status cue
- .activities__empty.archive-empty lives inside the same flex container as real cards

## Questions to Consider

- Does the standalone floating filter bar earn its place if the pillar CTA already filters?
- With only 3 fixed categories (1 empty), is a filter interaction the right mechanism vs. simply grouping the archive by category heading?
- Should the page's most elevated shadow-md treatment go to a category picker, or to the sections doing the persuasive work?
