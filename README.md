# Arcnest

The theme for arcnest.dev, built on [WP Elite](../wp-elite-theme) (copied from it, keeping its code: the `WpElite` namespace, `wp-elite/*` pattern slugs and `wp-elite` text domain, so fixes from the base theme merge in cleanly). The folder, theme name, ports and release zip are Arcnest's.

WP Elite is a pure block theme. Tokens live in its SCSS abstracts and `theme.json`; styles and scripts live in feature folders that load only where they're used (see [Theme structure](#theme-structure)).

It works without [Elite Blocks](../elite-blocks), and feeds the plugin through filters when it's active (`inc/integrations/elite-blocks.php`): Block Classes presets (`elite_blocks_class_presets`), the type scale as Text Styles (`elite_blocks_text_styles`) and `assets/icons/` (`elite_blocks_icons`).

## Requirements

- Node 22+ (`.nvmrc` pins 24)
- Docker (for `wp-env`)
- PHP 8.2+ and Composer (only for the PHP lint and static-analysis tools)

## Getting started

Clone the plugin next to the theme and build it once (the dev site runs it from there):

```
Projects/
├─ elite-blocks/      the plugin repo (npm install && npm run build)
└─ arcnest/          this repo
```

```bash
npm install
composer install
npm run build
npm run env:start
```

- Site: http://localhost:8892 (wp-env's default local test login)
- Test site: http://localhost:8893, its own database (`.wp-env.test.json`)

The repo is mounted as `wp-content/themes/arcnest` (WordPress names a theme by its folder, and that's the folder the release zip uses). `npm run env:start` / `env:stop` / `env:clean` act on both sites. `npm start` rebuilds on every change.

## Environments

The code a site runs depends on where it is:

| Environment | `WP_ENVIRONMENT_TYPE` | Theme code on the server |
|---|---|---|
| Local (wp-env) | `local` | The whole repo: `assets/` sources, `scripts/`, tests, plus `build/` from `npm start` |
| Staging | `staging` | Built package only (`npm run release`) |
| Production | `production` | Built package only |

Set the type in each server's `wp-config.php` (`define( 'WP_ENVIRONMENT_TYPE', 'staging' );`); WordPress treats a site without one as `production`.

On staging and production the **Theme File Editor** is off (`inc/environment.php`): theme code changes in this repo and is deployed, never edited on the server. Elite Blocks, when active, also turns off the Plugin File Editor and leaves itself out of the Plugins screen there. Override with `add_filter( 'wp_elite_locked', '__return_false' );`.

## Deployment

```bash
npm run release   # build, then arcnest.zip: build/, inc/, parts/, patterns/, templates/, fonts, icons, images, json, theme files
```

`.github/workflows/deploy.yml` ships that package to the server over SSH (rsync into `wp-content/themes/arcnest/`):

- a push to `main` deploys to **staging**;
- a tag `v*` (or running the workflow by hand and picking `production`) deploys to **production**.

Each is a GitHub environment (Settings → Environments: `staging`, `production`; add required reviewers to `production` to gate it) with these secrets:

| Secret | Example |
|---|---|
| `SSH_HOST` | `server.example.com` |
| `SSH_PORT` | `22` (Namecheap shared hosting uses `21098`) |
| `SSH_USER` | `cpaneluser` |
| `SSH_KEY` | a private key whose public key is in the server's `~/.ssh/authorized_keys` (cPanel → SSH Access) |
| `THEME_PATH` | `/home/cpaneluser/public_html/wp-content/themes/arcnest` |
| `SSH_KNOWN_HOSTS` | optional: the server's line from `ssh-keyscan -p 21098 server.example.com`; without it the host key is trusted on each run |

rsync runs with `--delete`, so files removed from the theme are removed from the server.

## Header and footer

Both are patterns (`patterns/header-default.php`, `patterns/footer-default.php`), made of WordPress's own blocks only, so they work without Elite Blocks. The template parts (`parts/header.html`, `parts/footer.html`) just hold them. Styles: `assets/layout/header/`, `assets/layout/footer/` (loaded with each part).

- **Header:** sticky; logo, the menu and **Let’s talk** (core Button, class `core-button--small`). The menu is WordPress's **Navigation** block with links to the home page's sections (`/#services`…), so they work from any page; `scroll-padding-top` keeps a section's heading below the header.
- **Header background** (`assets/layout/header/view.js` and `header.scss`, as on seemplicity.ai): the same at every scroll position and over any section. A **progressive blur** of eight layers (0.25px to 15px; the strongest only at the top, each weaker one reaching further down) under a purple tint that is solid at the top and fades out 40px below the bar. Without JS: one blur layer and the tint. Visitors who ask for less transparency (a system setting) get a solid bar.
- **Mobile first:** the styles are written for phones, then `media-breakpoint-up()` adds the larger screens. Below the laptop width the menu opens from a button (a 28px icon with a 44px tap area; Navigation's overlay, in the header's purple with a soft glow: the block's overlay colours). The open menu shows the logo and the close button where the bar has its logo and menu button, the links large, then a full-width **Let’s talk**: a Site Logo and a Button inside the Navigation block (`site-header__menu-logo`, `site-header__menu-cta`), shown only in the open menu. From tablets (768px) **Let’s talk** also sits in the bar, before the menu button; from the laptop width (992px, `up(lg)`) the links sit in the bar with **Let’s talk**. WordPress handles focus, Escape and closing (a link closes the menu too).
- **Demo video:** `design/video/` (not in the release zip): `demo.webm` (VP9) and `demo.mp4` (H.264), 1.8 MB each, 1920×1080, 65 s, and `demo-poster.jpg`. A real screen recording: a title card ("Build a hero in minutes", dark, so the video's grow effect shows from its first frame), then a new hero built in the editor with Elite Blocks (an Elite Section from the slash inserter; **Dark** and **Spacious** from Block Classes; two half columns; heading, text and a button with an arrow icon; an Elite Image from the Media Library with link type **Image popup**, **Rounded** and **Shadow**), published, its image opened in the popup on the page, and an end card. Upload the three to the Media Library and set them on the Demo section's Video Div. To re-record: `node design/video/record.mjs <dir>` with the local site running (it uses `arcnest-home.jpg` as Media Library image `IMAGE_ID`), then `design/video/encode.sh <dir> <out>` (ffmpeg).
- **Logos are uploaded in the CMS** (Settings → General), not shipped with the theme: **Logo** for the header and footer (`patterns/site-logo.php`, the Site Logo block: 144px wide in the header, 166px in the footer), **Secondary logo** for the footer's large wordmark (a Site Logo block set to "Secondary logo"; Elite Blocks). Both are SVGs, which Elite Blocks lets administrators upload. The files are in `design/logos/` (not in the release zip): `arcnest-logo.svg` (white, the Logo), `arcnest-wordmark.svg` (the Secondary logo), `arcnest-logo-dark.svg` (for light backgrounds, unused so far). On a new site: upload them there once (or `wp media import design/logos/arcnest-logo.svg --porcelain`, then `wp option update site_logo <id>` and `wp option update elite_blocks_secondary_logo <id>`).
- **Favicon:** also in Settings → General: **Site Icon** (WordPress's; the brand pack's `android-chrome-512x512.png`, for Safari, home screens and `/favicon.ico`) and **SVG favicon** (Elite Blocks; `design/logos/arcnest-favicon.svg`, the icon drawn for small sizes: a larger "a." than the app icon), which Chrome, Firefox and Edge use, sharp at every size. Upload both on each site (`wp media import design/logos/arcnest-favicon.svg --user=admin --porcelain`, then `wp option update elite_blocks_favicon_svg <id>`).
- **Footer:** logo and a line, three link columns (lists, so they don't add navigation landmarks) on a 12-column grid, the copyright line (the year updates itself) and the large wordmark: the Secondary logo, full width and cut off at the bottom, hidden from screen readers and loaded lazily (`inc/setup.php`).
- **In the Site Editor:** the look sits on the patterns' own groups (`.site-header__bar`, `.site-footer__main`), so a part edited on its own still shows on purple. Editing a part there saves it to the database, and from then on the pattern file no longer applies (Site Editor → the part → Reset to go back).
- **Max Mega Menu** isn't used (the base theme's integration stays in `inc/integrations/megamenu.php`, inactive without the plugin): it would load jQuery in `<head>` for a five-link menu.
- **Patterns:** the dev and test sites run in theme development mode (`WP_DEVELOPMENT_MODE`), so new pattern files show at once. On live sites WordPress caches the theme's pattern list until the theme's version changes: bump `WP_ELITE_VERSION` when releasing new patterns.


- **Type scale:** the titles and lead are fluid, as designed (`clamp()`: Title 1 44→94px, Title 2 34→64px, Title 3 22→28px, Lead 18→21px), so they match the design at every width, not only at each device's breakpoint.
- **Checks** (core List → Block Classes, `assets/blocks/core-list/`): a checklist, each item after a lime tick in a purple circle (`assets/images/check-lime.svg`). Use it in any section.
- **Section looks:** **Dark** is the brand's darkest purple with white headings, softer text and the bright lime dot and eyebrow; **Spacious** adds generous padding (`clamp(72px, 10vw, 144px)`), not margins, since sections touch.
- **Elite Sections** use the site's 1280px content width and side padding (`assets/blocks/elite-section/base.scss`), the same as the header and footer, not Bootstrap's stepped container widths. Header, content and footer touch (no gap between them); sections bring their own spacing.
- **Forms:** every Elite Form's fields (`assets/blocks/elite-form/base.scss`, loaded with the block): labels, 56px fields with rounded corners, errors under each field, two columns from tablets, the lime submit button. Colours are variables (`--form-field-bg`, `--form-error-color`…), so a section sets its own look (the Contact section's glassy fields on purple). See **Contact form**.
- **Buttons:** Elite Button is a 56px pill with its icon after the text nudging on hover (`assets/blocks/elite-button/base.scss`). Looks: **Primary** (lime), **Secondary** (purple), **Outline** (light backgrounds), **Ghost** (white outline, dark backgrounds), **Small** (46px), **Link**.
- **Dot:** the lime full stop after headings is a Span (text toolbar → More → Span → **Dot**, `elite-span--dot`): deeper lime on light backgrounds; a dark section sets `--elite-dot-color` to the bright one (the hero does).

## SEO and requests

- **SEO: Yoast SEO** (free, wordpress.org; the dev site installs it, `.wp-env.json`). The page title and meta description are set per page in Yoast's box in the editor (the Home page: "Arcnest: fast WordPress websites, no page builders" and the hero's line). The site's name and tagline are in Settings → General. With Yoast active, Elite Blocks' own share tags step aside. The share image for every page (Yoast → Settings → Site basics → Site image; a page can set its own in Yoast's Social tab) is `design/logos/arcnest-share-1200x630.png`: the brand pack's X header (wordmark on purple) with its flat purple extended top and bottom to the 1200×630 share size. On a new site: upload it and pick it there (`wp media import design/logos/arcnest-share-1200x630.png --user=admin --porcelain`, then set it in Yoast).
- **Few requests** (`inc/performance.php`, the same file as the base theme; this site's settings in `inc/site.php`): small files are printed in the page instead of loaded one by one. The base theme keeps the CSS every page uses in cached files and inlines up to 50 KB a page; Arcnest is one page, so `inc/site.php` keeps no files for caching and inlines every stylesheet WordPress can up to 150 KB in all (WordPress's default is 20 KB). If the site grows to more pages, delete those two filters to get the base theme's split back. Scripts: every theme or plugin script of up to 4 KB is printed as an inline module (it runs after the page is parsed and in order, as a deferred file does; not one that looks for its own `<script>` through `document.currentScript`, like Elite Slider, or uses `document.write`; filter `wp_elite_script_inline_size_limit`, 0 turns it off). The base theme has the same file. The Home page: 12 requests at load (was 41): the page, the font, the logos, the video's poster, Navigation's CSS and WordPress's, Contact Form 7's and the Interactivity API's scripts, which stay files, cached between pages.

## Contact form

The Contact section's form is **Contact Form 7** (free, wordpress.org), placed with an **Elite Form** (Elite Blocks' form library). The dev site installs CF7 itself (`.wp-env.json`); on a live site, install and activate it from Plugins.

- **Set it up on each site** (local, staging, production) with one command, after both plugins are active:
  ```bash
  wp arcnest contact-form
  ```
  It creates the CF7 form (name, email, website, message, in the theme's markup; the mail; the messages) and the Elite Form **Contact** (slug `contact`) that shows it, with the thank-you after sending. Run it again to bring an existing one back to the theme's version (it updates the same two forms, nothing duplicated). Locally: `npx wp-env run cli wp arcnest contact-form`. The command and the form's fields: `inc/integrations/contact-form-7.php`. The **Contact** pattern finds the Elite Form by its slug.
- **Mail:** enquiries go to the site's admin email (Settings → General), with Reply-To set to the sender, so replying answers them. Edit the recipient or text in Contact → Contact Forms → Contact → Mail (running the command again resets them). The local site can't send mail (no mail server; the form says "couldn't be sent"). On the server, send through real SMTP (an SMTP plugin with the domain's mailbox), or many messages land in spam.
- **Lean:** CF7's CSS is off (the theme styles forms: `assets/blocks/elite-form/` for the fields, the section for its colours) and its script loads only on pages showing a form (the home page), not site-wide.
- **Fields:** each sits in `<div class="form-field">` with its label (`form-field--full` spans both columns; `form-field__optional` for "(optional)"); the submit is `<button class="form-submit">` (the lime button, arrow included). Errors show under their field in space kept for them, so nothing moves; screen readers hear CF7's status.
- **Spam:** CF7 has no spam filter of its own. If spam arrives, add Akismet or CF7's Cloudflare Turnstile integration (Contact → Integration).

## Theme structure

One feature = one folder, holding its styles and (optionally) its script. Each folder loads **only where it's used**, so a page carries the CSS and JS of what's on it, not of every design on the site (b3rg bundles everything into one file).

```
wp-elite/
├─ functions.php        loads inc/
├─ inc/
│  ├─ setup.php         theme supports, editor styles, pattern category, colour palette
│  ├─ manifest.php      reads the generated assets/json/ files
│  ├─ assets.php        global CSS; loads each feature folder where it's used
│  ├─ fonts.php         preloads the body font
│  └─ integrations/     elite-blocks.php (classes, text styles, icons for the plugin), megamenu.php
├─ parts/  templates/   layout only: header part, a pattern, footer part (`site-header` / `site-footer`)
├─ patterns/            named by group: header-*, footer-*, section-*, page-*, template-*
├─ screenshot.png       Appearance → Themes thumbnail (1200 × 900)
├─ tests/php/           theme PHP checks (npm run test:php)
└─ assets/
   ├─ styles/           global CSS (build/theme.css, every page)
   │  ├─ abstracts/     no CSS output: data files + _functions.scss (every function and mixin)
   │  ├─ base/          plain elements: typography, links, lists, forms…
   │  └─ main.scss  editor.scss
   ├─ blocks/<block-class>/   modifier classes for one block
   ├─ layout/<part>/          a template part's styles (header, footer)
   ├─ sections/<name>/        one section design: its root class + its parts
   ├─ pages/<body-class>/     a page type (single-post, search…)
   ├─ vendor/<plugin>/        styles for a plugin's own markup
   ├─ utils/                  helpers for scripts
   ├─ json/                   generated by `npm run classes`; don't edit, do commit
   ├─ fonts/<family>/         self-hosted fonts (woff2 + licence), registered in theme.json
   ├─ images/                 theme images for patterns and CSS
   └─ icons/                  the icon set for Elite blocks
```

| Folder | Built to | Loads | In the editor |
|---|---|---|---|
| `blocks/<block-class>/` | `build/blocks/<block-class>.css` | With that block (a folder that isn't a block, e.g. `elite-span`, with its class) | Always |
| `layout/<part>/` | `build/layout/<part>.css` | With that template part (slug `header` → `layout/header/`) | Always |
| `sections/<name>/` | `build/sections/<name>.css` | On pages using its root class `elite-section--<name>` (the whole class: not `…--<name>-large`) | Always |
| `pages/<body-class>/` | `build/pages/<body-class>.css` | On pages with that body class: `single-post`, `single-case-study`, `page-template-landing`, `post-type-archive-resource`, `search`, `error404`… | Always (body-class selectors don't match there) |
| `vendor/<plugin>/` | `build/vendor/<plugin>.css` | While the plugin is active: `// Active when: NAME` in its SCSS (a constant, class or function, e.g. `MEGAMENU_VERSION`), after the plugin's own CSS | No |

**Text in templates goes in patterns.** `.html` templates and parts can't be translated, so they hold only structure: a template is the header part, a hidden `template-*` pattern with its main content, and the footer part; the footer part is the `footer-default` pattern. Patterns are PHP, so their text goes through `esc_html_e( '…', 'wp-elite' )` and shows up for translators (`wp i18n make-pot`). The index, archive and search templates share one posts grid (`template-query-grid`). Core blocks with their own translated defaults are left without text: the Search block shows WordPress's "Search" when it has no label or button text.

**Samples** (keep, change or delete them; each shows a convention):

| Folder | Shows |
|---|---|
| `sections/hero/` | The home page's intro (pattern **Hero**, `patterns/section-hero.php`): badge, H1 with the lime **Dot** span, lead and two buttons beside a speed report card (score ring, metrics) and a lime stat; 7/5 columns from laptops, stacked below. It **starts under the header** (`--section-margin-top`, not in the editor) so the header's blur sits on it. CSS only (no view.js). On load the right side animates in, as in the prototype (`animation.scss`): the report card rises, its ring draws, the metrics follow one by one, the lime stat pops in; the text on the left stays still so the heading paints at once. Not in the editor, nor for visitors who ask for less motion. The ring is a conic gradient; set its fill with `--hero-score` (default 98). Parts: `Hero › Badge, Lead, Actions, Copy, Visual, Report, Report Top, URL, Tag, Gauge, Score, Gauge Label, Gauge Title, Metrics (core/list), Stat, Stat Number`. |
| `sections/demo/` | "See it in action" (pattern **Demo video**, `patterns/section-demo.php`, ID `demo`): eyebrow, H2 and a line at the content width, then a full-width 16:9 video (at most 92% of the screen's height). The video is the **Video** Elite Div's background video (Background → Video: WebM as the source, MP4 as the fallback, a poster; autoplay, muted, loop), so Elite Blocks loads it only near the screen, pauses it off screen and adds the pause button. `view.js` grows it from an inset rounded card to full width as it scrolls in (not with reduced motion, not in the editor). Without a video, a placeholder shows. Parts: `Demo › Head, Lead, Media`. |
| `sections/strip/` | A slim band (pattern **Tech strip**): "Built with modern, native WordPress" and the technologies as pills, a core **list** (Enter adds one), wrapping under the label when they don't fit. CSS only. Parts: `Strip › Inner, Label, Pills (list)`. |
| `sections/compare/` | "The problem" (pattern **Comparison**, `patterns/section-compare.php`, ID `why`): eyebrow and H2 with the lead bottom-aligned beside them from laptops, then two cards (a page builder's PageSpeed score and numbers, light, against Arcnest's, purple): stacked on phones, side by side from tablets, equal heights. The scores are **Elite Counters** (they count up as they scroll in); `view.js` slides the cards in from either side (not when already on screen, with reduced motion or in the editor). Parts: `Comparison › Lead, Cards (row), Card, Good, Card Head, Card Title, Tag, Score (counter), Caption, Numbers (list), Note`. |
| `sections/services/` | "What we do best" (pattern **Services**, ID `services`) on the light lilac background: the heading and a line, then four service cards (number, title, text, an Elite Button link with an arrow along the bottom), the second **Featured** ("Most popular", purple). 4 across from laptops, 2 on tablets, stacked on phones, equal heights; they lift on hover, and `view.js` makes them rise in one by one (not when already on screen, with reduced motion or in the editor). Parts: `Services › Head, Lead, Grid (row), Card, Featured, Number, Text, Flag, Link (button)`. |
| `sections/theme/` | "Our foundation" (pattern **Our theme**, ID `theme`): the heading, a line and a **Checks** list beside a dark "Arcnest blocks" panel (title, tag, a search field's look and block tiles, a list: Enter adds a tile). Side by side from laptops; on phones and tablets the panel goes under the text (at most 560px wide). `view.js`: the checks rise in one by one, the panel scales up and its tiles follow (not when already on screen, with reduced motion or in the editor). Parts: `Theme › Lead, Visual (column), Panel, Panel Top, Panel Title, Panel Tag, Search, Tiles (list)`. |
| `sections/process/` | "How we work" (pattern **Process**, ID `process`) on the darkest ink: the eyebrow, heading, a line and a lime button, beside four numbered steps (title, a line, how long), between thin lines. From laptops the heading side stays in view (sticky, 120px from the top) while the steps scroll past; on phones and tablets the steps go under it. `view.js` makes the steps rise in one by one (not when already on screen, with reduced motion or in the editor). Parts: `Process › Head (column), Lead, Button, Steps (column), Step, Number, Step Title, Step Text, Duration`. |
| `sections/stats/` | The numbers band (pattern **Stats**, `patterns/section-stats.php`): four **Elite Counters** (prefix, number, suffix: "<1s", "95+", "0", "24h"; turn **Animate** off for ones that shouldn't count, like "<1s") with a line under each, set off by a lilac rule on their left. 4 across from laptops, 2 by 2 below. `view.js` makes them rise in one by one (not when already on screen, with reduced motion or in the editor); the counters count up as they scroll in. Parts: `Stats › Grid (row), Stat, Value (counter), Caption`. |
| `sections/agencies/` | "For agencies" (pattern **Agencies**, ID `agencies`): a lime box (rounded, with a faint circle and purple dots) holding the eyebrow, H2, a line and a purple **Partner with us** button (a mailto link: change it in the button's link), beside four points as white cards with check circles (a core **list**: Enter adds one). Side by side from laptops, stacked below. CSS only. Parts: `Agencies › Box, Lead, CTA (button), Points (column), Points (list)`. |
| `sections/faq/` | "Questions" (pattern **FAQ**, `patterns/section-faq.php`, ID `faq`): the eyebrow and H2 beside an **Elite Accordion** of five questions (add one with the accordion's + button; the answer is the item's Body). The first starts open; **FAQ schema** is on, so search engines get the questions and answers. The **Questions** look draws lines between them and a round lilac plus that turns into a purple and lime minus when open (keep the accordion's Indicator on Plus). Side by side from laptops (4 + 7 columns), the questions under the heading below; on phones the answers use the full width. `view.js` makes the questions rise in one by one (not when already on screen, with reduced motion or in the editor). Parts: `FAQ › List (column), Questions (accordion)`. |
| `sections/contact/` | "Have a project in mind?" (pattern **Contact**, `patterns/section-contact.php`, ID `contact`) on purple, in a narrow centred column (880px): the eyebrow, H2 with a lime **?** (the Dot span), a line, the contact form (an **Elite Form**, the **Form** look: a glassy panel with light fields; the thank-you replaces it once sent; see **Contact form**), a small note and the **Founding** box (dashed lime outline, the **Badge** pill beside the title and text, under them on phones). A lime glow from the bottom and soft dots (CSS only: a large faint circle; on laptops and up lime, lilac and purple dots, one purple on phones). `view.js` makes the content rise in one part after another (not when already on screen, with reduced motion or in the editor). Parts: `Contact › Lead, Form (elite/form), Note, Founding (div), Badge, Founding Title, Founding Text`. |
| `sections/cta/` | A section with a script: the content fades up when scrolled into view (`whenVisible`), shown at once if already on screen at load or with reduced motion; part `elite-div--cta-actions` (full-width buttons on phones). Used by the **Call to action** pattern. |
| `pages/single-post/` | Blog posts: heading rhythm, quotes, captions, tag pills, previous/next; part `elite-div--post-callout` (a box for a post's content, styled by its class so the editor shows it). |
| `sections/not-found/` | The 404 page (pattern **Page not found**, `patterns/template-404.php`, used by `templates/404.html`; edit it in **Appearance → Editor → Templates → Page: 404**) in the home hero's look: on the darkest purple with the same glows and dots, centred and filling the screen, starting under the header. A big **404** (white fading to lilac, its lime **0** a Dot span; text style `error-code`), the H1 with a lime dot, a line, **Back to home** and **Start a project** (full width on phones) and "Or jump to" links into the home page. CSS only. Parts: `Not found › Code, Lead, Actions (div), Links`. |
| `sections/speed-hero/`, `sections/speed-results/`, `sections/speed-cta/` | The **Speed test** page (Elementor vs Arcnest; pattern **Speed test page**, `patterns/page-speed-test.php`, offered when a new page is created, built from six section patterns `section-speed-*`). **Intro** (`speed-hero`): the home hero's look, centred, starting under the header: a badge, the H1, a line, the test's facts as pills (a list) and two buttons to `#results` and `#method` (full width on phones). **Scores** reuse the home page's comparison cards (`elite-section--compare`, ID `results`). **Full results** (`speed-results`): a core Table (`core-table--speed`: metric, Arcnest in bold, Elementor, difference in purple; scrolls sideways on narrow phones) and a note. **Why it's faster** reuses the services cards (ID `why`), **How we tested** the FAQ accordion (no FAQ schema, ID `method`), and the **close** (`speed-cta`) is a dark band with two buttons. The numbers are edited in place in the page (Pages → Speed test). **Draft figures** from the local Lighthouse test until the PageSpeed Insights results from the server replace them: keep the page a draft until then. |
| `pages/search/` | Search results. |

- **In a folder:** every `.scss` not starting with `_` is compiled into the folder's one stylesheet; `view.js` (if any) into its one script.
- **Styles in `<head>`:** block themes render the page before printing `<head>`, so styles found while rendering still land there; small files are inlined, like core block styles.
- **Scripts** load with their styles, **deferred, in the footer**; dependencies come from the build's `.asset.php`.
- **Editor:** all layout, section and page styles come as one file (`build/editor-features.css`), since the editor can't know what a post will use. Scripts don't run in the editor, which shows the static layout.
- **By hand**, e.g. in a custom template: `\WpElite\enqueue_feature( 'sections', 'hero' );`. The `wp_elite_load_feature` filter (`$load, $kind, $name`) can stop any folder loading.
- **SCSS abstracts:** every folder sits two levels down, so `@use "../../styles/abstracts" as *;` gives everything. Data lives in its own files; **every function and mixin is in `_functions.scss`**:

  | File | Holds |
  |---|---|
  | `_colors.scss` | `$colors` (the editor palette) |
  | `_text-styles.scss` | `$text-styles` (the type scale), `$text-props` |
  | `_breakpoints.scss` | `$grid-breakpoints` (Bootstrap 5), `$devices` |
  | `_variables.scss` | `$radius-*`, `$border-color`, `$duration-*`, `$ease`, `$z-layers` |
  | `_functions.scss` | `media-breakpoint-up/down/between/only()`, `breakpoint-min/max/next()`, `text-style()`, `text-value()`, `button-look()`, `z()` |

- **Mobile first:** write the phone styles plainly, then add to them for larger screens with `media-breakpoint-up()`. Don't style desktop first and undo it with `media-breakpoint-down()`: phones then download and override rules they never use. The theme's own CSS (type scale, header, footer, sections) follows this.
- **Breakpoints** are **Bootstrap 5's** (`xs` 0, `sm` 576, `md` 768, `lg` 992, `xl` 1200, `xxl` 1400), the same as the Elite Blocks grid, with Bootstrap's mixins under the same names and results, so b3rg/Bootstrap SCSS ports as is:

  ```scss
  @include media-breakpoint-up(md) { … }          // 768px and up (tablet and larger)
  @include media-breakpoint-up(lg) { … }          // 992px and up (laptop and desktop)
  @include media-breakpoint-down(lg) { … }        // under 992px (only when a rule must not reach larger screens)
  @include media-breakpoint-between(md, xl) { … } // 768px to 1199.98px
  @include media-breakpoint-only(md) { … }        // 768px to 991.98px
  ```

  Elite Blocks' **devices** are Bootstrap breakpoints too (`$devices`: laptop below `xl`, tablet below `lg`, mobile below `md`), so CSS that matches a block's per-device settings uses the same mixins: mobile is the base, `media-breakpoint-up(md)` tablet and larger, `up(lg)` laptop and desktop, `up(xl)` desktop. There are no other breakpoint mixins. Both maps feed `assets/json/breakpoints.json` for scripts.

### Scripts

A folder's `view.js` is plain modern JavaScript (no jQuery), bundled on its own. Set up **each copy** on the page by itself, so two copies of a section don't clash:

```js
import { onReady, whenVisible, isDevice, prefersReducedMotion } from '../../utils';

function setUp( section ) {
	whenVisible( section, () => {
		// Start something only when it's near the screen.
	} );
}

onReady( () => {
	document.querySelectorAll( '.elite-section--hero' ).forEach( setUp );
} );
```

- `onReady( fn )`: runs once the HTML is ready (at once for deferred scripts).
- `whenVisible( element, fn, rootMargin = '200px' )`: runs once the element is near the screen; returns a function to stop watching.
- `isDevice( 'tablet' )`: that device or smaller, as the SCSS `media-breakpoint-down()` of its breakpoint (`'desktop'` is above laptop). `deviceQuery()` gives the media query.
- `mediaBreakpointUp( 'md' )`, `mediaBreakpointDown( 'lg' )`: Bootstrap's media queries, for `window.matchMedia( … )`.
- `prefersReducedMotion()`: skip autoplay and animations when true.
- **Use the plugin first:** accordion, tabs, slider, popup, counters, forms and TOC are Elite Blocks; a section's script is only glue. The theme never imports plugin code: it can listen to the plugin's events (`elite-form:submitted`, `elite-video:play`…) and use `window.EliteBlocks` after checking it's there.

## Adding classes and folders: `npm run add`

This replaces b3rg's `npm run ng`. Every Elite block has a default class (Section: `elite-section`). A theme file named `<default-class>--<modifier>.scss` becomes that modifier class in the block's **Block Classes** multi-select (Styles tab), just like b3rg's `e-stn/e-stn--dlt.scss`.

```bash
npm run add -- section dark                    # blocks/elite-section/elite-section--dark.scss → class elite-section--dark, label "Dark"
npm run add -- section primary-small --label "Primary (small)"
npm run add -- core/button pill                # any block: blocks/core-button/core-button--pill.scss
npm run add -- section outline --style         # native block style instead (core Styles panel, one at a time)

npm run add -- sections/hero --js              # a section design: sections/hero/elite-section--hero.scss + view.js
npm run add -- sections/hero div hero-media    # a part: sections/hero/elite-div--hero-media.scss ("Hero › Hero Media" on Elite Div)
npm run add -- pages/single-post               # page-type styles: pages/single-post/single-post.scss
npm run add -- pages/single-post div author    # a part for blog posts' content
npm run add -- layout/header --js              # the header's styles and script
npm run add -- vendor/gravity-forms --when GFForms   # a plugin's styles, while class GFForms exists

npm run classes                                # regenerate after editing/deleting files
```

Things to know:
- **Labels:** taken from the file name (`primary-small` → "Primary Small"), or from a `// Label: …` comment at the top of the file. Parts of a section, page or layout are labelled under it: "Hero › Hero Media".
- **Section folders:** the root class file is named after the folder (`sections/hero/elite-section--hero.scss`); its class is what loads the folder, so style the parts under it (`.elite-section--hero .elite-div--hero-media`). Any other block can be the root: rename the file (`elite-div--hero.scss`).
- **One class, one place:** `npm run classes` stops if two folders define the same class (it would show twice in Block Classes): prefix parts with the section's name, as b3rg does (`elite-div--hero-media`).
- **Generated files:** `npm run classes` writes `assets/json/` (`manifest.json`, plus `colors.json`, `text-styles.json`, `breakpoints.json` from the abstracts). It runs automatically before `build` and `start`. Commit them, because the theme reads them at runtime.
- **Other files:** any other `.scss` file in a folder (for example `base.scss`) is compiled without adding an editor option. Files starting with `_` are partials.
- **Restarting the watcher:** after creating a new folder, restart `npm start`.
- **Spacing in Section modifiers:** values set in the CMS (Spacing - Top/Bottom) always win. Anything not set there comes from the modifier. Padding is plain CSS on `.section-inner`. Margin uses `--section-margin-top` and `--section-margin-bottom`, because WordPress's layout CSS overrides plain `margin-*` on sections. See `elite-section--spacious.scss`.
- **Clearing classes:** the dropdown can be emptied completely. Unlike b3rg, removing the last class is allowed.
- **Where classes are saved:** Block Classes saves into the block's `className` attribute, and the block adds it to its markup. Elite blocks have no "Additional CSS class(es)" field. Their Advanced tab only has WordPress's **Additional CSS**, which is custom CSS for that one block.

## Fonts, images and variables

**Fonts** are self-hosted: one folder per family in `assets/fonts/` (the `.woff2` files and their licence), registered in `theme.json` under `settings.typography.fontFamilies[].fontFace`. WordPress then writes the `@font-face` rules on the site and in the editor, and the family shows in the editor's font picker.

- **Plus Jakarta Sans** (variable, weights 200–800, Latin only, 27 KB, SIL Open Font License, `assets/fonts/plus-jakarta-sans/OFL.txt`; from Fontsource's copy of Google Fonts) is the **Body** family, used by the whole site through the Body text style. For other scripts (Latin Extended, Vietnamese), add those files as more `fontFace` entries with a `unicodeRange`.
- **Loading:** `font-display: swap` (text shows at once in a fallback font). The body font's files are **preloaded** first thing in `<head>` (`inc/fonts.php`); the `wp_elite_preload_fonts` filter picks which families (slugs) to preload: only what the top of every page uses, since each preload competes with the page's first image.
- **Heading** is a second family preset, pointing to the Body family for now (`"fontFamily": "var(--wp--preset--font-family--body)"`). Every title, display and title-like component style uses it (`font-family: $-heading` in `_text-styles.scss`), so a different heading font is one change: add its folder (woff2 files and licence) and set the Heading preset's `fontFamily` and `fontFace` in theme.json. Add its slug to `wp_elite_preload_fonts` if the top of every page uses it. **Mono** is a preset for code (system fonts, nothing to load).

**Images** for the theme's own design live in `assets/images/`.

- **In a pattern:** `<?php echo esc_url( get_theme_file_uri( 'assets/images/sample-hero.svg' ) ); ?>` (see the Hero pattern). Content images belong in the Media Library, not here.
- **In SCSS:** point at the file from the feature folder: `background-image: url("../../images/shape.svg");`. The build inlines SVGs into the CSS and copies other images (png, jpg, webp) to `build/images/` with a hash, so caches refresh when they change.
- **Sample:** `sample-hero.svg`, the Hero pattern's illustration.

**Variables** (`styles/abstracts/_variables.scss`): shared values that aren't editor tokens: corners (`$radius-sm|md|lg|xl|xxl|pill`: 4, 8, 12, 16, 24px, round), lines (`$border-color`: the text colour at 12%, visible on any light background), motion (`$duration-fast|medium|slow`: 0.2, 0.4, 0.6s, `$ease`) and one z-index scale (`$z-layers`, read with `z(header)`), so layers never fight. Everything else already has a home: colours in `_colors.scss`, the type scale in `_text-styles.scss`, breakpoints in `_breakpoints.scss`, and spacing, shadows and fonts as theme.json presets (`var(--wp--preset--shadow--lg)`), which editors can pick too. Unlike b3rg's `_variables.scss`, there are no image-path, border or one-off shadow lists: write the value where it's used, and move it here once it repeats.

## Colours

Theme colours live in one place: the `$colors` map in `assets/styles/abstracts/_colors.scss`, as in b3rg's `_color-palette.scss`.

- **What the map feeds:** `npm run classes` (which also runs before `build` and `start`) writes `assets/json/colors.json`, and the theme registers it as the editor palette. It drives every colour picker (Elite's background and border pickers included), the `has-*-color` classes and the `--wp--preset--color--*` variables.
- **In theme SCSS:** `@use "../../styles/abstracts" as *;` gives you `$colors`.
- **Adding a colour:** add it to the map and run `npm run classes`. Keys are slugs, so `"primary"` shows as "Primary".

## Typography

- **Type scale:** every text look on the site is a style in `assets/styles/abstracts/_text-styles.scss` (`$text-styles`), with its family, size, weight, line height, letter spacing and case (fluid or per device). It sets `h1`–`h6` and `body` site-wide and defines the `--text-<style>-<prop>` variables. Use it in theme SCSS with `@use "../../styles/abstracts" as *; @include text-style("caption");`, then set only what's the part's own (colour, margins; the weight or line height if they differ, e.g. a bold caption or a single-line pill).
  - **Editor styles** (the Text Style dropdown and Font size picker): Title 1–6, Display 1–3 (big numbers: 72→120px, 48→80px, 36/46px, extra bold), Lead, Body, Body Small (15px), Small (14px), Caption (13px), Tag (12px bold), Eyebrow.
  - **Component styles** (`editor: false`: kept in the scale, not offered in the editor): button, button-small (Elite and core buttons; theme.json's button typography reads them too), menu-large, badge, question (FAQ), card-title, step-title, step-text, step-meta, card-text, stat-number and error-code (the 404 page's big number). The last four sit close to an editor style (the comment on each says which); point their parts to it when the design allows, and the site gets one style fewer.
  - **Enforced:** Stylelint (`.stylelintrc.json`) rejects `font`, `font-family`, `font-size`, `letter-spacing` and `text-transform` anywhere in `assets/` except `assets/styles/`, so a new look is added to the scale, not written into a part.
- **One scale for every block:** the type scale is also theme.json's font sizes (`inc/setup.php`, like the palette): core blocks' **Font size** picker (core Paragraph, Heading, Post Title, Site Title…) lists the same editor styles (Title 1–6, Display 1–3, Lead, Body, Body Small, Small, Caption, Tag, Eyebrow), and each size is the scale's own per-device value (`--wp--preset--font-size--title-1: var(--text-title-1-font-size)`), so 56px on desktop is 36px on a phone wherever it's used. WordPress's default and fluid sizes are off; templates and patterns use the same names (`"fontSize":"title-5"`). The picker sets the size only; a Text Style (Elite blocks) sets the whole style. Change a size in `_text-styles.scss` and both follow.
- **Text blocks** (Elite Heading, Elite Paragraph, Text Style, Tag) are the plugin's; see its README. Text Styles come from this scale through `elite_blocks_text_styles`.
- **Span inside text:** select words, open More (⌄) in the text toolbar → **Span**, and tick classes from `assets/blocks/elite-span/elite-span--*.scss` (the theme loads that CSS on pages that use it). The result is `<span class="elite-span elite-span--highlight">`. For a whole block as a `<span>`, set Elite Paragraph's tag to SPAN.

## Icons

- **Where they live:** every `assets/icons/<slug>.svg` (78 to start: arrows, chevrons, UI, contact, media, commerce, business, social) is offered in the Button and Icon pickers, labelled from its file name (`arrow-right.svg` → "Arrow Right"). Add an icon by dropping an SVG in that folder.
- **How to draw them:** use `currentColor` (`stroke="currentColor"` or `fill="currentColor"`) so icons follow the button's text colour and hover state. They render at `1em`.
- **How they're stored:** blocks save only the slug and print the SVG when the page renders, so editing a file updates every button that uses it. SVGs are sanitised (scripts, event handlers and non-drawing elements removed; definitions such as `<defs>`, `<clipPath>`, `<mask>` and gradients removed with what's inside them, and fills that used them take the text colour) and hidden from screen readers.
- **Buttons:** looks are theme modifiers in `assets/blocks/elite-button/`, built with the `button-look()` mixin from `styles/abstracts/_functions.scss` (colours plus hover and focus states, as b3rg's `common-button`). Add one with `npm run add -- button <name>`.

## Quality checks

```bash
npm run lint         # ESLint (scripts and view.js), Stylelint
npm run test:unit    # Vitest
npm run test:php     # PHP checks inside WordPress: tests/php/*.check.php
composer run phpcs   # WordPress coding standards
composer run phpstan # static analysis, level 6
```

CI (`.github/workflows/ci.yml`) runs all of these on every push and pull request. The block e2e tests live in the plugin repo and run against this theme.
