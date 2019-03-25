# jet-toc-builder
WordPress Plugin for including a TOC based on the H2-4 tags in a post for a given ID.

\[jet-toc-builder id="your-post-id"\]

It will read the provided post_id's post, replace the content with some new content that is marked up with anchors, and generate a list of links to those anchors.

*This is a work in progress.*

**Highly recommended:** Make use of a [caching plugin](https://wordpress.org/plugins/wp-fastest-cache/) of some sort on the pages that will use this feature. Make use of one in general anyway, at least on pages that are static unless you explicitly edit them. That will prevent this plugin from constantly overwriting your post content every time the page loads.
