
---

# SR Projects Advanced

A structured, extensible WordPress plugin for managing and displaying Projects using:

* Custom Post Type (CPT)
* Shortcodes
* AJAX (Load More)
* Filtering & Search
* Custom REST API
* Template override system
* Admin settings panel

---

# 📌 Features

* Custom Post Type: `sr_project`
* Archive & Single template rendering
* Dynamic shortcode builder
* Grid / List layout
* Pagination / Load More support
* Search & Status filter
* Theme template override system
* Custom REST API (`srpa/v1`)
* Clean folder-based architecture

---

# 📦 Installation

1. Upload the plugin folder to:

```
wp-content/plugins/
```

2. Activate **SR Projects Advanced** from WordPress Admin.
3. Go to:

```
Dashboard → SR Projects
```

to configure settings.

---

# 🗂 Project Structure

```
sr-projects-advanced/
│
├── sr-projects-advanced.php        # Main plugin bootstrap file
├── index.php
│
├── includes/
│   │
│   ├── admin/
│   │   │
│   │   ├── css/
│   │   │   └── srpa-admin.css
│   │   │   
│   │   ├── js/
│   │   │   └── ssrpa-admin.js
│   │   │   
│   │   ├── templates/
│   │   │   └── srpa-admin-dashboard.php
│   │   │   └── srpa-admin-settings.php
│   │   │   
│   │   ├── admin-menu.php
│   │   ├── admin-scripts-and-styles.php
│   │
│   │
│   ├── api/
│   │   └── rest-api.php
│   │
│   ├── common/
│   │   └── cpt.php
│   │   └── metabox.php
│   │
│   ├── frontend/
│   │   └── css/
│   │   │   └── srpa-frontend.css
│   │   └── js/
│   │       └── srpa-frontend.js
│   │   ├── archive-sr_project.php
│   │   ├── ajax.php
│   │   ├── template-loader.php
│   │   ├── shortcode.php
│   │   ├── styles-and-scripts.php
│   │   └── templates/
│   │       ├── archive-sr_project.php
│   │       │── single-sr_project.php
│   │       │── grid.php
│   │       └── list.php
│
└── README.md
```

---

# 🧱 Custom Post Type

Post Type: `sr_project`
Slug: `sr-project`

Registered in:

```
includes/common/cpt.php
```

---

# 🌐 Frontend URLs

## Archive Page

```
https://yoursite.com/sr-project/
```

Generated dynamically using:

```php
get_post_type_archive_link('sr_project');
```

---

## Single Project Page

```
https://yoursite.com/sr-project/project-name/
```

---

# 🎨 Template Override System

The plugin loads templates via:

```
includes/frontend/template-loader.php
```

It uses `template_include` filter.

## Override Archive Template

Create in your theme:

```
wp-content/themes/your-theme/sr-project/archive-sr_project.php
```

## Override Single Template

Create in your theme:

```
wp-content/themes/your-theme/sr-project/single-sr_project.php
```

If not found, plugin fallback templates are loaded from:

```
includes/frontend/templates/
```

---

# 🔗 Shortcode

Base shortcode:

```
[srpa_projects]
```

## Supported Attributes

| Attribute       | Description              |
| --------------- | ------------------------ |
| template_type   | grid or list             |
| pagination_type | pagination or load_more  |
| posts_per_page  | Number of posts per page |
| load_more_count | Items loaded per click   |
| enable_filter   | 1 or 0                   |
| enable_search   | 1 or 0                   |

## Example

```
[srpa_projects template_type="grid" pagination_type="load_more" posts_per_page="6" enable_filter="1" enable_search="1"]
```

Shortcode logic is defined in:

```
includes/frontend/shortcode.php
```

---

# ⚙ Admin Settings

Admin dashboard template:

```
includes/admin/templates/srpa-admin-dashboard.php
```

Settings are stored in:

```php
get_option('srpa_settings')
```

The dashboard dynamically generates the shortcode based on saved settings.

---

# 🔌 REST API

The plugin registers a custom REST route.

## Namespace

```
srpa/v1
```

## Endpoint

```
GET /wp-json/srpa/v1/projects
```

Defined in:

```
includes/api/rest-api.php
```

---

## Example Request

```
https://yoursite.com/wp-json/srpa/v1/projects
```

---

## Example JS Usage

```javascript
fetch('/wp-json/srpa/v1/projects')
  .then(res => res.json())
  .then(data => console.log(data));
```

---

# 🧠 How It Works (Architecture Overview)

1. CPT is registered.
2. Templates are conditionally loaded via `template_include`.
3. Shortcode queries projects dynamically.
4. AJAX handles load more (if enabled).
5. REST API exposes structured JSON.
6. Admin dashboard manages settings and shortcode generation.

---

# 🔐 Security

* All outputs escaped using `esc_html()`, `esc_url()`, `esc_attr()`
* REST endpoint uses proper callback structure
* No direct file access (ABSPATH check)

---

# 🚀 Extending the Plugin

You can:

* Add new meta fields
* Extend REST response fields
* Add custom taxonomy filters
* Add Gutenberg block wrapper
* Add custom capabilities
* Add caching for REST endpoints

---

# 🛠 Development Notes

* Uses WordPress coding standards
* Modular folder-based architecture
* Separated Admin / Frontend / API
* Easy to scale into enterprise-level plugin

---

# 📄 License

GPL v2 or later

---

# 👨‍💻 Author

Developed by Satyakee Ray

---

If you want, I can also create:

* WordPress.org compliant readme.txt
* Composer-ready structure
* Professional marketplace documentation version
* Developer documentation (technical spec)
* API documentation in Swagger format

Tell me which level you want next 🚀
