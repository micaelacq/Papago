import zipfile
import xml.etree.ElementTree as ET
import json
import sys
import os

papago = {}
i = 0

def loadfile():
  filename = ''
  if (len(sys.argv) > 1):
    file = sys.argv[1]
  else:
    for root, dirs, files in os.walk("."):
      for filename in files:
        if filename[-4:] == '.xml':
          file = filename
          break

  if not file:
    print('no xml file found!')
  return file


def papagoParse(topic, parent):
  global i
  id = i
  obj = {'label' : topic.attrib['text'], 'options' : [], 'parent' : ''}
  for child in topic:
    option = {'option' : child.attrib['text']}
    for grandChild in child:
      if grandChild.attrib['text'][0:5] == 'Fiche':
        option['value'] = grandChild.attrib['text']
      else:
        i += 1
        option['value'] = str(i)
        papagoParse(grandChild, id) 
      obj['options'].append(option)
  if parent > -1:
    obj['parent'] = str(parent)
  papago[id] = obj
      
file = 'papago.opml'
if (len(sys.argv) > 1):
    file = sys.argv[1]
try: 
  tree = ET.parse(file)
  root = tree.getroot()
  if root.tag== 'opml':
    try:
      papagoParse(root[1][0], -1)
      try:
        with open(file[:-4] + 'json', 'w') as json_file:
          json.dump(papago, json_file, indent=4, sort_keys=True)
          print('json file written: ' + file[:-4] + 'json')
      except:
        print('json file could not be written!')
    except:
      print('parsing error')
  else:
    print('no opml file')
except:
  print('xml error!')


