# Papago
The assistant who gives you personalised advice on your rights, obligations and funding opportunities regarding Open Access publishing in Switzerland

## General information
The concept, logic tree and original answer sheets in French were developed by Micaela Crespo from the Department of Research and International Relations of the University of Lausanne.
The source code for this tool was developed by Thomas Henkel of the Cantonal and University Library of Friboug. It can be reused, modified, built upon and improved freely, but we ask that the authorship of the code be attributed to the Papago project.

If you have any questions or comments about Papago, you can write to us at open.access@unil.ch. In addition, if you encounter an error or malfunction, do not hesitate to report it to us.

## Collaborators
This project was strongly inspired by the tool on the Rights and Obligations of Researchers to Distribute their Publications in Open Access developed by the University of Lille, Willo.

We would like to thank Romain Féret of the Digital Library Department at the University of Lille for his collaboration, advice and support in the design of this tool.

This tool was developed as a collaboration between the Université de Lausanne and the Université de Fribourg. We wholehartedly thank our colleagues from the Swiss National Open Access Work Group and the Research Consultants at the University of Lausanne for their feedback during beta testing.

## Description
Papago is an online questionnaire that provides respondents with customized scenarios.

In view of the multilingual situation in Switzerland, as well as this project, and the conversational nature of the personal assistant, we have named the Papago tool, a word in Esperanto meaning "parrot".  

Papago is composed of 2 complementary parts:

- A form that provides customized scenarios based on the answers to the questions with a final summary of the respondent's situation.
- Personalised sheets in PDF format, accessible by a link at the end of the form, which make it possible to detail the guarantor's situation and his or her rights, obligations and financing opportunities. These files are hosted on the servers of the University of Lausanne.

Papago seeks to bring together in one place all the essential information on the rights and obligations of researchers with regard to the open access distribution of their publications. Based on the answers provided by the respondents, it makes it possible to build a personalized scenario, adapted to the researcher's situation.

## Logic tree (flowchart)
The flowchart can be broken down into 2 phases (these two phases are transparent to the respondent):

- Phase 1 focuses on the source of funding and includes at least 2 questions regardless of the answer to the first question. The sponsor must indicate whether its publication has been publicly funded. If so, it must indicate the origin of this funding. If the respondent's publication is the result of an H2020 research project, he or she must indicate whether the project began before or after January 1, 2017. If his publication is not the result of a project that has been specifically funded, he must indicate whether at least half of his salary comes from public funds.
- Phase 2 is about publication: the respondent must indicate whether the publication is distributed under a Creative Commons license or on a paid basis. If the respondent's publication is from an H2020 research project, he or she must indicate whether the publication is already being distributed from an open archive. This makes it possible to know if they must take additional steps to meet their obligations.

## Use Cases
### Standalone GitHub Page
Just go to https://micaelacq.github.io/Papago and you can use Papago out of the box.

For different languages, you can add a language paramater. The following languages are supported:
- https://micaelacq.github.io/Papago/?lang=fr (French: default)
- https://micaelacq.github.io/Papago/?lang=de (German)
- https://micaelacq.github.io/Papago/?lang=en (English)
- https://micaelacq.github.io/Papago/?lang=it (Italian)

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

To change the title or spacing you can work on the html code at the bottom of the document (after the `</script>` tag).
