---
target: resources/views/client/branch/index.blade.php
total_score: 22
max_score: 32
na_heuristics: 5,10
p0_count: 2
p1_count: 1
timestamp: 2026-08-15T11-58-17Z
slug: resources-views-client-branch-index-blade-php
---
**Method: dual-agent (A: aa4e6595b0a29e603 · B: a03da376523f5dbb3)**

## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 3 | No layout shift; "Xem trên bản đồ" lacks external-link cue |
| 2 | Match System/Real World | 2 | h3 sits on the small muted line (location); the visually dominant bold line (name) is an unmarked div |
| 3 | User Control & Freedom | 3 | Fine |
| 4 | Consistency & Standards | 2 | Page contradicts its own DESIGN.md-documented reasoning |
| 5 | Error Prevention | n/a | No form input on this page |
| 6 | Recognition > Recall | 3 | Day-grouped chips good; "Cơ sở N" eyebrow is a meaningless sort artifact |
| 7 | Flexibility & Efficiency | 2 | Flat list, no filter/sort, unlike sibling Activity page |
| 8 | Aesthetic & Minimalist | 3 | Clean hairline rhythm, undercut by duplicated "Cơ sở" wording |
| 9 | Error Recovery | 4 | Honest, consistent empty states |
| 10 | Help & Documentation | n/a | Not applicable to marketing page |
| **Total** | | **22/32** | **Acceptable (69%)** |

## Direct answer to user's hierarchy-inversion question

NOT sound - two confirmed defects, verified against live DB and code, not speculation.

[P0] Duplicate "Cơ sở" wording in real production data: id=1 location="CƠ SỞ ĐỨC TRỌNG", id=10 location="CƠ SỞ LIÊN NGHĨA" - admin typed "CƠ SỞ" into the location field itself, so the eyebrow "Cơ sở 1" stacks directly above title "CƠ SỞ ĐỨC TRỌNG", repeating the word twice adjacently.

[P0] h3 sits on the wrong line: `<h3 class="branch-row__title">` renders the small muted location text, while the visually dominant bold text (`.branch-row__name`, 19px/800) is an unmarked div - semantic heading and visual heading disagree.

[P1] Confirmed via code read (lines 88-91): `.branch-row__name` only renders inside `@if ($branch->location)`. When location is empty, the branch name shows only in the small muted h3 style with no bold rendering at all - an untested degrade path.

Root cause of the inversion being the wrong fix: the page's own closing CTA says "Chọn cơ sở gần nhất" - location/area is the decision-relevant field for a parent, not the specific venue's proper name. Making name more prominent than location optimizes the wrong field.

## Other issues
[P2] No per-branch persuasion - each row is address+hours+map, nothing differentiates branches for a comparing parent, reads like a database dump.
[P3] No scale plan - flat list works at 2-3 branches, not at 10+; sibling Activity page already has filtering.

## Recommended fix
1. Revert to location-as-primary (h3, bold) / name-as-secondary - but fix the real complaint (secondary line was too low-contrast to read) by darkening/weighting the secondary line, not by inverting which one is dominant.
2. Remove the duplicated "Cơ sở" wording - since the eyebrow already says "Cơ sở N," the title should render location without a redundant "Cơ sở" prefix.
3. Fix the empty-location fallback so the branch name still renders in a reasonably prominent style even without a location value.
