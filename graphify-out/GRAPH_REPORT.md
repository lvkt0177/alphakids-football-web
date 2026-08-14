# Graph Report - .  (2026-08-11)

## Corpus Check
- Large corpus: 452 files · ~918,281 words. Semantic extraction will be expensive (many Claude tokens). Consider running on a subfolder.

## Summary
- 519 nodes · 652 edges · 94 communities (85 shown, 9 thin omitted)
- Extraction: 96% EXTRACTED · 4% INFERRED · 0% AMBIGUOUS · INFERRED: 28 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Homepage Design System & About Page
- Composer Autoload Config
- Admin/Client CRUD Controllers (Faq, Activity, Branch)
- Admin Setting Controller & Requests
- Registration Status & Admin Dashboard
- Activity Category & Admin Activity CRUD
- Composer Scripts
- Admin Branch Controller & About Controller
- Helpers & Unaccented Search
- NPM Frontend Build Deps
- Proof Point Admin CRUD
- Auth Login Controller & Request
- User Model & DB Seeder
- App Service Provider & Site Settings Composer
- Homepage Video Split Interaction (home.js)
- Feature Test
- About Background Image (Purple/Lavender)
- Lead Capture Banner Image
- Admin Layout Partials
- Unit Test
- Admin Confirm Modal JS
- Client Layout Partials (Header/Footer)
- Admin Toast JS
- Club Logo & Brand Identity
- Video Section Background Image
- Robots.txt
- Laravel README

## God Nodes (most connected - your core abstractions)
1. `Controller` - 33 edges
2. `DESIGN.md — Alpha Kids Design System` - 24 edges
3. `Branch` - 23 edges
4. `Activity` - 21 edges
5. `Faq` - 17 edges
6. `ProofPoint` - 16 edges
7. `Registration` - 15 edges
8. `Setting` - 14 edges
9. `Section-Layout-Repetition Ban` - 11 edges
10. `SettingController` - 10 edges

## Surprising Connections (you probably didn't know these)
- `AboutController` --references--> `AboutController::splitStat()`  [EXTRACTED]
  app/Http/Controllers/Client/AboutController.php → DESIGN.md
- `Page: Về CLB (About)` --references--> `AboutController`  [EXTRACTED]
  DESIGN.md → app/Http/Controllers/Client/AboutController.php
- `Admin-Configurable Video Thumbnail (home_video_thumbnail)` --references--> `VideoSettingRequest`  [EXTRACTED]
  DESIGN.md → app/Http/Requests/Admin/Setting/VideoSettingRequest.php
- `Accordion (Q&A) Shared Primitive` --references--> `Faq`  [EXTRACTED]
  DESIGN.md → app/Models/Faq.php
- `Flexible Proof Grid` --references--> `ProofPoint`  [EXTRACTED]
  DESIGN.md → app/Models/ProofPoint.php

## Import Cycles
- None detected.

## Hyperedges (group relationships)
- **Named Design Rules** — design_two_gold_rule, design_color_consistency_lock, design_reserved_strength_exception, design_one_display_face_rule, design_section_layout_repetition_ban, design_no_side_tab_rule, design_hairline_over_shadow_rule [EXTRACTED 1.00]
- **Signature Components** — design_sticky_scroll_timeline, design_hero_mesh_gradient, design_closing_cta_component [EXTRACTED 1.00]
- **C.A.R.E Four Thinking Pillars** — product_care_method, product_pillar_giao_tiep, product_pillar_danh_gia, product_pillar_ung_xu, product_pillar_lanh_dao [EXTRACTED 1.00]

## Communities (94 total, 9 thin omitted)

### Community 0 - "Homepage Design System & About Page"
Cohesion: 0.07
Nodes (45): OtherPagesImageGroups, DESIGN.md — Alpha Kids Design System, Page: Về CLB (About), Accordion (Q&A) Shared Primitive, Signature Component: Closing CTA, Club Intro Section (Split), The Color Consistency Lock, Flexible Proof Grid (+37 more)

### Community 1 - "Composer Autoload Config"
Cohesion: 0.04
Nodes (44): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, files, psr-4, config (+36 more)

### Community 2 - "Admin/Client CRUD Controllers (Faq, Activity, Branch)"
Cohesion: 0.07
Nodes (10): FaqController, ActivityController, BranchController, FaqController, HomeController, MethodController, ProgramController, Controller (+2 more)

### Community 3 - "Admin Setting Controller & Requests"
Cohesion: 0.08
Nodes (8): SettingController, AboutStatsSettingRequest, FeaturedActivityRequest, GeneralSettingRequest, ImageSettingRequest, VideoSettingRequest, Setting, Illuminate\Foundation\Http\FormRequest

### Community 4 - "Registration Status & Admin Dashboard"
Cohesion: 0.08
Nodes (7): DashboardController, RegistrationController, RegistrationController, RegistrationRequest, QuickRegistrationRequest, RegistrationRequest, Registration

### Community 5 - "Activity Category & Admin Activity CRUD"
Cohesion: 0.11
Nodes (6): ActivityController, ActivityRequest, Activity, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsToMany

### Community 6 - "Composer Scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 7 - "Admin Branch Controller & About Controller"
Cohesion: 0.12
Nodes (6): BranchController, AboutController, AboutController::splitStat(), BranchRequest, Branch, initCountUp()

### Community 8 - "Helpers & Unaccented Search"
Cohesion: 0.13
Nodes (8): remove_vietnamese_accents(), scopeOrWhereUnaccentedLike(), scopeWhereUnaccentedLike(), ActivityFactory, BranchFactory, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static

### Community 9 - "NPM Frontend Build Deps"
Cohesion: 0.10
Nodes (19): axios, concurrently, laravel-vite-plugin, devDependencies, axios, concurrently, laravel-vite-plugin, tailwindcss (+11 more)

### Community 10 - "Proof Point Admin CRUD"
Cohesion: 0.15
Nodes (3): ProofPointController, ProofPointRequest, ProofPoint

### Community 12 - "User Model & DB Seeder"
Cohesion: 0.25
Nodes (6): User, DatabaseSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable

### Community 13 - "App Service Provider & Site Settings Composer"
Cohesion: 0.22
Nodes (5): AppServiceProvider, SiteSettingsComposer, Illuminate\Support\Facades\View, Illuminate\Support\ServiceProvider, Illuminate\View\View

### Community 14 - "Homepage Video Split Interaction (home.js)"
Cohesion: 0.22
Nodes (4): Play Hint Overlay (.intro-video__play-hint), Video Section Split Background (.intro-video-section__dark-bg), initVideoPlayHint(), initVideoSplit()

### Community 15 - "Feature Test"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 16 - "About Background Image (Purple/Lavender)"
Cohesion: 0.60
Nodes (5): AlphaKids Purple/Lavender + Orange Accent Palette, Homepage Hero Section Decorative Background Purpose, Kids Football (Soccer) Marketing Site Branding, Homepage Background Image (background.png), Watercolor Brush-Stroke Visual Style

### Community 17 - "Lead Capture Banner Image"
Cohesion: 0.50
Nodes (5): Alphakids Football Brand Color Palette (Purple/Navy + Yellow), Faint Ghosted Sneaker/Football Boot Motif, Lead Capture Banner (Marketing CTA Section), Purple/Yellow Diagonal Split Background Design, Lead Capture Banner Background Image

### Community 18 - "Admin Layout Partials"
Cohesion: 0.40
Nodes (4): partials.admin._confirm-modal, partials.admin._sidebar, partials.admin._toast, partials.admin._topbar

## Ambiguous Edges - Review These
- `Lead Capture Banner (Marketing CTA Section)` → `Faint Ghosted Sneaker/Football Boot Motif`  [AMBIGUOUS]
  public/images/home/background_lead_capture_banner.png · relation: conceptually_related_to

## Knowledge Gaps
- **78 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+73 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **9 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **What is the exact relationship between `Lead Capture Banner (Marketing CTA Section)` and `Faint Ghosted Sneaker/Football Boot Motif`?**
  _Edge tagged AMBIGUOUS (relation: conceptually_related_to) - confidence is low._
- **Why does `Controller` connect `Admin/Client CRUD Controllers (Faq, Activity, Branch)` to `Admin Setting Controller & Requests`, `Registration Status & Admin Dashboard`, `Activity Category & Admin Activity CRUD`, `Admin Branch Controller & About Controller`, `Proof Point Admin CRUD`, `Auth Login Controller & Request`?**
  _High betweenness centrality (0.088) - this node is a cross-community bridge._
- **Why does `Activity` connect `Activity Category & Admin Activity CRUD` to `Helpers & Unaccented Search`, `Admin/Client CRUD Controllers (Faq, Activity, Branch)`, `Admin Setting Controller & Requests`, `Registration Status & Admin Dashboard`?**
  _High betweenness centrality (0.040) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _78 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Homepage Design System & About Page` be split into smaller, more focused modules?**
  _Cohesion score 0.06693877551020408 - nodes in this community are weakly interconnected._
- **Should `Composer Autoload Config` be split into smaller, more focused modules?**
  _Cohesion score 0.044444444444444446 - nodes in this community are weakly interconnected._
- **Should `Admin/Client CRUD Controllers (Faq, Activity, Branch)` be split into smaller, more focused modules?**
  _Cohesion score 0.07307692307692308 - nodes in this community are weakly interconnected._