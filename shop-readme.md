# SportsHealing Theme Phase 2 Notes

The first conversion phase intentionally ignores these Carenix templates:

- `carenix-html/sign-in.html`
- `carenix-html/wishlist.html`
- `carenix-html/shop.html`
- `carenix-html/shop-details.html`
- `carenix-html/register.html`
- `carenix-html/pricing.html`
- `carenix-html/forget-password.html`
- `carenix-html/cart.html`
- `carenix-html/checkout.html`

Phase 2 can convert these into WooCommerce/auth/account flows or custom WordPress templates once the CMS/content model is agreed.

Current foundation:

- Static page templates only remain for general pages and the three homepages, with section show/hide controls wired through ACF.
- Three homepage templates are selectable in the CMS: Homepage 1, Homepage 2, and Homepage 3.
- Custom post types exist for Services, Portfolio, and Doctors.
- Services, Portfolio, Doctors, and Blog are seeded as CMS entries and render through live WordPress listing/detail templates.
- Header and footer custom post types exist for CMS-managed layout variants.
- Header/Footer records can target All templates, Homepage 1 / Standard Pages, Homepage 2, or Homepage 3.
- Header and footer logos are intentionally pulled from Appearance > Customize > Site Identity.
- Navigation is pulled from WordPress menus: Primary Menu, Footer Quick Links, Footer Services Links, and Footer Legal Links.
- Header/footer markup is split into `inc/header-footer/header/`, `inc/header-footer/footer/`, and `inc/header-footer/partials/`.
- Header/Footer ACF fields live in `inc/header-footer/acf-fields.php`.
- One-time Header/Footer record creation lives in `inc/seeders/header-footer-seeder.php`.
- Page/content ACF fields live in `inc/acf-template-fields.php`.
- Importable ACF JSON lives at `wp-content/themes/sportshealing/acf-import/sportshealing-acf-field-groups.json`.
- ACF local JSON sync files live in `wp-content/themes/sportshealing/acf-json/`.
- Seeders are split by area in `inc/seeders/`: pages, blog, services, portfolio, doctors, and header/footer.
- Public page templates are grouped under `templates/` by area: home, pages, blog, gallery, services, portfolio, and doctors.

Template naming note:

- WordPress internally calls listing routes “archives”, but the theme files use listing/detail names: `service-listing-template.php`, `service-detail-template.php`, `portfolio-listing-template.php`, `portfolio-detail-template.php`, `doctor-listing-template.php`, `doctor-detail-template.php`, `blog-listing-template.php`, and `blog-detail-template.php`.

Next suggested phase:

- Replace the remaining static page-template copy/images with granular ACF fields where needed.
- Decide whether shop/cart/checkout should be WooCommerce or custom templates.
- Replace remaining static reference/detail page templates with Markdown-only references once no longer needed in the CMS.

## Future WooCommerce Integration Notes

Preferred approach:

- Use WooCommerce for product, cart, checkout, account, order, payment, tax, and stock logic.
- Keep all visual customization inside `wp-content/themes/sportshealing/` so the WooCommerce plugin is never edited directly.
- Match the SportsHealing look and feel adaptively rather than forcing a 1:1 copy of the old static HTML.
- The goal is continuity of brand and UX so users feel they are still on the same site, even if the commerce templates are slightly more native to WooCommerce.

Implementation strategy:

- Install WooCommerce normally inside `wp-content/plugins/woocommerce/`.
- Add theme support and WooCommerce setup code inside the theme.
- Override WooCommerce frontend templates from the SportsHealing theme rather than editing plugin files.
- Reuse the global theme shell: `header.php`, `footer.php`, shared assets, menus, typography, buttons, spacing, and section patterns.
- Port the existing `shop.html`, `shop-details.html`, `cart.html`, and `checkout.html` designs as visual references, not strict HTML sources of truth.
- Preserve WooCommerce forms, notices, totals, hooks, and actions wherever possible so upgrades remain manageable.

Theme-side work to do when ready:

- Add WooCommerce compatibility setup in the theme and enqueue any shop-specific assets from the theme only.
- Create theme template overrides for shop archive, single product, cart, checkout, and account areas as needed.
- Map SportsHealing classes and layout structure onto WooCommerce output so the brand styling carries across the store.
- Style WooCommerce states carefully: sale badges, notices, validation errors, empty cart, related products, quantity controls, coupon forms, and checkout summaries.
- Replace placeholder shop/cart links in header or section partials with live WooCommerce URLs once the plugin is active.
- Decide whether mini-cart behavior should use WooCommerce fragments or a custom theme-side presentation layer built on WooCommerce data.

Architecture guidance:

- Styling belongs in the theme.
- Small presentation helpers can live in `functions.php` or `inc/`.
- If any commerce-specific business rules become large or site-critical, move that logic into a custom plugin under `wp-content/plugins/` instead of burying it in the theme.
- Keep everything under `wp-content`, but avoid editing WooCommerce core/plugin files so updates remain safe.

Success criteria:

- Store pages feel visually native to SportsHealing.
- Customers do not feel like they have left the site.
- WooCommerce remains updateable without losing customizations.
- Theme overrides stay as lean as possible and use plugin hooks where practical.
