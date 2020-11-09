# custom-post-grid

## This plugin modifies the default behaviour from Display Posts plugin.

These new default settings show the Thumbnail along with the post/page title in a grid with no excerpt

Use shortcode to create the list.  e.g. 

[display-posts post_type="page, post" id="12631, 12543, 12447, 14257, 15033, 15006, 14981, 18259, 17358, 26641" orderby="title" order="ASC" posts_per_page="10"]

or to show just the child pages of a page:

[display-posts post_type="page" orderby="title" order="DESC" post_parent="current"] (can use post_parent="8")

## CSS

The CSS file only covers the layout of the sub-pages/posts.  Any backgrounds our changes to colours should be done in the theme css.