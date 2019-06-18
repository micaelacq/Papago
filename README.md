# Papago
The assistant who gives you personalised advice on your rights, obligations and funding opportunities regarding Open Access publishing in Switzerland
## Use Cases
### Standalone GitHub Page
Just goo to https://micaelacq.github.io/Papago an you can use Papago out of the box.

For different languages, you can add a language paramater. Following languages are supported:
- https://micaelacq.github.io/Papago/?lang=fr (french: default)
- https://micaelacq.github.io/Papago/?lang=de (german)
- https://micaelacq.github.io/Papago/?lang=en (english)

It is possible to integrate the standalone GitHub page with an iframe into your website:
```html
<iframe src="https://micaelacq.github.io/Papago"></iframe>
```
### Integrate Papago directly into your webpage
To integrate Papago directly into your webpage, go to [index.html](index.html) and copy all code up from the `<script>` tag into your own page.

Papago uses [_jQuery_](https://jquery.com/), [_Bootstrap 4_](https://getbootstrap.com/) and [_Font Awsome 4_](https://fontawesome.com/v4.7.0/). Make sure that this resources are integrated into the header section of your page.

If your site uses _Bootstrap 3_ you can set the parameter _bootstrap3_ to `true`.

There are other parameters you can change in the paremeter section :
- lang: language of Papago
- papagoUrl: URL of the Papago decision tree, directs to the [trees](trees) directory.
- pdfUrl: URL of the PDF directory. In this way you can integrate your own PDFs.
- pdfSuffix: Suffix of your PDF files (including "."), e.g. ".pdf".
- bootstrap3: set to `true` if you are using _Bootstrap 3_
