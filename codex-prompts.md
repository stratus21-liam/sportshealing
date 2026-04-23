# Codex Prompts

## WordPress ACF Template-Part Build Standard

Use this prompt when asking Codex to build or refactor WordPress template parts in this project:

```text
Build this WordPress theme work using the SportsHealing ACF standard.

Requirements:
- Read the existing template part, page template, ACF JSON, helper functions, and seeders before editing.
- Do not use raw HTML fields for section content.
- Do not hide unrelated content inside vague repeater rows like Item 1, Item 2, Image 3, etc.
- ACF fields must be clearly named and labelled by purpose.
- Decorative assets must be labelled as Shape 1, Shape 2, Background Image, Circle Image, etc.
- Content images must be labelled by placement or purpose, such as Left Image, Right Image, Top Image, Bottom Image, Video Image, Before Image, After Image.
- Buttons must use separate Button Label fields and page selector fields where the target is an internal page.
- For repeated visual/content cards, use repeater rows with explicit subfields: icon/image, title, copy, URL only when a manual URL is truly needed.
- For real CMS content, use post selectors instead of manual card repeaters:
  - Blog sections select WordPress posts.
  - Doctor sections select `sh_doctor` posts.
  - Service sections select `sh_service` posts.
  - Portfolio sections select `sh_portfolio` posts.
- Templates should read selected CMS posts and use titles, excerpts, permalinks, listing/detail images, roles/categories/meta, and social links from those records.
- Template code must use escaped output and existing theme helpers where possible.
- If a section needs fallback content, use sane fallbacks in code but still expose the correct ACF controls.
- Update both local `acf-json` field groups and `acf-import/sportshealing-acf-field-groups.json`.
- Add or update seed/backfill logic so existing installs receive usable default values for any new fields.
- Run PHP lint on every touched PHP file.
- Validate ACF JSON after changes.
- Search for stale patterns before finishing:
  - `sportshealing_acf_section_item_value(...)` where the index is standing in for a named field.
  - `sportshealing_acf_section_item_image_url(...)` where the image is actually a shape or named placement image.
  - static detail links like `blog-details.html`, `doctor-details.html`, `services-details.html`, `portfolio-details.html`.
  - hardcoded blog authors/dates such as Admin or March dates.
  - hardcoded checklist/card content that should be editable.

Before final response, tell me:
- Which template parts changed.
- Which ACF groups changed.
- Which seed/backfill function was added or updated.
- What verification commands passed.
```

