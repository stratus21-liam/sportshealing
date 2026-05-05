# Style WooCommerce Like SportsHealing

This document is the preferred plan for adding shop functionality later.

The goal is not to rebuild the old static `shop.html`, `shop-details.html`, `cart.html`, and `checkout.html` page-for-page.

The goal is to:

- install WooCommerce normally
- keep WooCommerce handling products, cart, checkout, account, payments, stock, and order logic
- make WooCommerce look and feel like the SportsHealing theme
- keep all customization inside `wp-content`
- never edit the WooCommerce plugin directly

## Core Principle

Use WooCommerce as the commerce engine and SportsHealing as the presentation layer.

Customers should feel like they are still on the same site, even if the underlying shop pages are powered by WooCommerce templates and hooks.

This is better than forcing the old static HTML into custom commerce flows because it keeps the build maintainable and much safer to update.

## Where Customization Should Live

Keep all work inside `wp-content`:

- `wp-content/plugins/woocommerce/`
  Install WooCommerce normally. Do not edit its core files.

- `wp-content/themes/sportshealing/`
  Put theme styling, template overrides, helper functions, and WooCommerce integration here.

- `wp-content/plugins/`
  If large custom business rules are ever needed, create a small custom plugin here rather than burying that logic in the theme.

## Recommended Approach

1. Install WooCommerce normally.
2. Let WooCommerce create or manage the main commerce pages.
3. Update the SportsHealing theme to support WooCommerce.
4. Style WooCommerce screens so they match the site branding, spacing, buttons, typography, and layout rhythm.
5. Replace old static links such as cart/shop placeholders with live WooCommerce URLs.
6. Only override WooCommerce templates in the theme when CSS or hooks are not enough.

## What To Reuse From This Theme

Reuse the existing SportsHealing shell and design language:

- global `header.php` and `footer.php`
- theme colours
- typography choices
- buttons
- spacing system
- forms styling
- cards and content containers
- existing utility/helper functions where appropriate

The store should feel native to SportsHealing, not like a separate microsite.

## What To Use As Visual Reference

Use these old static files as design references only:

- `carenix-html/shop.html`
- `carenix-html/shop-details.html`
- `carenix-html/cart.html`
- `carenix-html/checkout.html`

Do not treat them as strict HTML sources that must be copied exactly.

Instead, borrow:

- layout ideas
- section structure
- button styles
- card appearance
- image treatment
- spacing
- typography
- form styling

Then adapt WooCommerce output into that visual language.

## How To Implement It

### Phase 1: Install and Baseline

- Install and activate WooCommerce.
- Confirm shop, product, cart, checkout, and account pages exist.
- Confirm the SportsHealing header and footer render correctly on WooCommerce pages.
- Add WooCommerce support in the theme if needed.

### Phase 2: URL Wiring

- Replace static shop/cart/checkout links in the theme with live WooCommerce URLs.
- Update header cart links to point to WooCommerce cart.
- Update any product or CTA buttons that should lead into WooCommerce flows.

This should include places currently using old static references such as `shop.html` or `cart.html`.

### Phase 3: CSS-First Styling

Start by styling WooCommerce with theme CSS before overriding templates.

Target areas such as:

- shop/archive grids
- single product layout
- add-to-cart buttons
- sale badges
- price display
- breadcrumbs
- cart table
- quantity controls
- coupon forms
- checkout fields
- totals summary
- notices and validation errors
- account navigation

The first objective is visual consistency, not custom markup.

### Phase 4: Selective Theme Overrides

Only if CSS and WooCommerce hooks are not enough:

- override WooCommerce templates from inside the SportsHealing theme
- keep overrides small and focused
- avoid copying more template code than necessary
- prefer hook-based changes when possible

Use overrides only where markup structure must change to properly fit the design.

### Phase 5: UX Polish

Review the store as a connected part of the site:

- empty cart state
- checkout success flow
- mobile responsiveness
- form error states
- button consistency
- cart icon behavior
- related products
- notices and alerts

The store should feel integrated, not bolted on.

## Practical Rules

- Do not edit WooCommerce plugin files.
- Do not hard-fork large chunks of WooCommerce templates unless necessary.
- Prefer CSS and hooks before template overrides.
- Keep WooCommerce logic intact.
- Use theme files for styling and presentation.
- Use a custom plugin only if business logic grows beyond theme concerns.

## Success Criteria

This approach is successful when:

- WooCommerce handles the commerce logic cleanly
- SportsHealing controls the look and feel
- customers do not feel like they left the site
- updates to WooCommerce remain manageable
- all custom work stays under `wp-content`

## Short Reminder For Future Work

When ready, do not rebuild the shop from static HTML first.

Start with real WooCommerce pages, make them inherit the SportsHealing experience, then selectively adapt markup only where the native output cannot be styled well enough.
