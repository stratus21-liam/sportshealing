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
