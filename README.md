# tinymce-bootstrap-plugin

tinyMce Bootstrap Plugin - Extend tinyMce using Bootstrap components and code snippets


![tinyMce Bootstrap Plugin](https://www.tinymce-bootstrap-plugin.com/assets/images/old/tinymce-bootstrap-plugin-preview.png)

---

## Important

### This plugin is built for **Tinymce 4 + Bootstrap 3**

It was previously sold on Codecanyon, now I decided to make it available for free.

### A New plugin for **Tinymce 5 + Bootstrap 4** is now released

[Tinymce Bootstrap plugin for Tinymce 5 + Bootstrap 4](https://www.tinymce-bootstrap-plugin.com/demo/index)

The new plugin is [available on Codecanyon](https://1.envato.market/GByBk) at low price & awesome features

---

## Main Features

- Store &amp; Recall Any Element, Any Custom Code (Bootstrap or not)
- 13 plugins in 1
- 13 Visual Editors
- Easy to install
- Fully responsive
- Multilanguage

## Visual editors

![tinyMce Bootstrap Plugin](https://www.tinymce-bootstrap-plugin.com/assets/images/old/screenshot-1.png)

Access to visual editors to create/edit the following Bootstrap 3 elements:

- Alert
- Badge
- Breadcrumb
- Button (+ icons)
- Icon
- Image
- Label
- Pager
- Pagination
- Panel
- Table
- Template

## Available Icon Font Libraries

- glyphicon
- ionicon
- fontawesome
- weathericon
- mapicon
- octicon
- typicon
- elusiveicon
- materialdesign

## Snippet Tool

The **Snippet** tool allows to **create, edit, store &amp; recall any custom code snippet**, Bootstrap or not.

You can for example easily **store and reuse** :

Bootstrap Modal, Carousel, Navbar, Navbar Tabs, Nav Tabs, Accordion, Popover, ... No Limit !

Create **your own snippets** easily - Just paste your code.

Each element is customizable with usual Bootstrap options.

Use your own Bootstrap css**, wich will be directly rendered either in tinyMce editor and plugin visual editors

## Requirements

- tinyMce v.4
- Bootstrap css
- jQuery
- php server

## Installation

1. Download and unzip tinyMce
2. Copy **plugin/bootstrap** dir to your tinyMce **plugins** dir
3. include jQuery to your page
4. Add Bootstrap plugin to tinyMce plugins &amp; toolbar:

```html
   <script>
        tinymce.init({
        selector: "textarea",
        plugins: [
        "bootstrap"
        ],
        toolbar: "bootstrap"
    });
   </script>
```
