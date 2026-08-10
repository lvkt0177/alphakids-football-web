# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Vietnamese parents of children from age 3 who are comparing extracurricular/sports programs and deciding where to enroll their child. They evaluate a specific physical branch near them (address, weekday/weekend schedule) before committing, and the copy speaks to them in Vietnamese throughout.

## Product Purpose

Alpha Kids Football Club ("Bóng đá tư duy" — thinking football) is a multi-branch kids' football academy. The site's job is to move a parent from interest to a booked trial session (Đăng ký học thử), which the academy then converts into ongoing, paid enrollment at a physical branch. The stated promise is broader than sport: training players while developing children's thinking, character, and confidence through a positive football environment.

## Positioning

The academy's differentiator is a named, structured teaching method (C.A.R.E) built around four core "tư duy" (thinking/mindset) pillars taught through football: giao tiếp (communication), đánh giá (self-evaluation/emotional control), ứng xử (behavior/cooperation), and lãnh đạo (leadership). This is positioned as "học mà chơi — chơi để trưởng thành" (learn through play, play to grow) rather than pure athletic training — a claim a generic football class could not make.

## Operating Context

- Multiple real, currently operating physical branches, each with its own address, weekday/weekend class schedule, and map location.
- A trial-registration funnel: parent submits child name, birth year, phone, preferred trial date, and branch(es) of interest; staff follow up ("Chúng tôi sẽ liên hệ với bạn sớm nhất").
- An admin back office (separate from the public site) manages branches, activities/programs, incoming trial registrations, and site settings/content (home banner, images, video, general info).
- Activities/programs are categorized and can be flagged as featured for homepage/program-page display.

## Capabilities and Constraints

- Public client site: home, about ("Về CLB"), method ("Phương pháp giáo dục"), program, branch listing, FAQ, and trial registration — About and Method pages are current stubs still to be built out (content sections B1–B6 and C1–C6 respectively are not yet written).
- Admin panel: activity management, branch management, registration (lead) management, and site settings.
- All public-facing copy is in Vietnamese; there is no stated multi-language requirement.
- Built on Laravel (Blade views, vanilla CSS, Vite build).

## Brand Commitments

- Name: Alpha Kids Football Club / Alpha Kids Football.
- Tagline concept: "Bóng đá tư duy" (thinking football), for children from age 3.
- Named method: C.A.R.E training method.
- Four named core-thinking pillars: tư duy giao tiếp, tư duy đánh giá, tư duy ứng xử, tư duy lãnh đạo — these are fixed program vocabulary, not placeholder labels.

## Evidence on Hand

- Branch data (addresses, schedules, features, map embeds) and activities are real and currently in production use via the admin panel — treat them as factual, not sample data.
- No testimonials, press, or case studies are present in the codebase yet; future work must not fabricate them.
- About and Method pages have no real copy yet (explicit "to be built" placeholders) — do not treat their current placeholder text as approved content.

## Product Principles

- Every parent-facing surface should shorten the path to booking a trial at a real, nearby branch.
- The "thinking football" positioning and its four named pillars are the core differentiator and should stay visible, not be diluted into generic sports-academy messaging.
- Content must reflect real, currently operating branches and programs — no invented locations, schedules, or claims.
- Admin-authored content (branches, activities, settings) is the source of truth for what appears publicly; the public site should degrade gracefully when admin content (e.g. a banner image) is missing, as the home page already does.
