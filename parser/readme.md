# Papago Tree Parser

## Tree Creation

To create the Papago decision trees (located in https://github.com/micaelacq/Papago/tree/master/trees) we use [X-Mind](https://xmind.app/). The trees are structured as follows: Question -> Answer -> Question 2 -> Answer 2 -> etc.

Have a look at the english decision tree as an example:

![Papago Decision Tree](https://github.com/micaelacq/Papago/blob/master/parser/papago-en.png?raw=true)

The red and blue squares are only for orientation and have no influence on the tree structure.

## Tree Parsing
After ther creation, the tree ist exported from X-Mind to an .opml file. The .opml file is afterwards parsed with opml2papago.py to create the tree in JSON-format.

`python3 opml2papago.py papago.opml`

This creates (or overwrites) the JSON file with the same name (papago.json).

## Tree Parsing Legacy Mode
It was possible to parse X-Mind files from version 8 directly. If you are using still this version, you can use xmind2papago.py in the same way:

`python3 xmind2papago.py papago.xmind`

This extracts the 'content.xml' from the X-Mind container, parses the file, and creates (or overwrites) a file named always 'papago.json'.
