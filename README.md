zenpage_macros
===============

A [Zenphoto](http://www.zenphoto.org) plugin to provide various content macros for Zenpage CMS items.
For content/extra content of a Zenpage page or news article:

```
[PAGECONTENT <titlelink> <publish true|false> <title true|false> <header string>]
[PAGEEXTRACONTENT <titlelink> <publish true|false>]
[NEWSCONTENT <titlelink> <publish true|false>  <title true|false> <header string>]
[NEWSEXTRACONTENT <titlelink> <publish true|false>]
```

Excerpts of the direct subpages (1 level) of the current Zenpage page:

```
[SUBPAGES <headline> <excerpt length> <readmore text> <shortenindicator text>]
```

All are optional, set to empty quotes ('') if you only want to set the last one for example.

This generates the following html:

```html
<div class='pageexcerpt'>
  <h3>page title</h3>
  <p>page content excerpt</p>
  <p>read more</p>
</div>
```
