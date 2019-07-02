import zipfile
import xml.etree.ElementTree as ET
import json
import sys
import os

papago = {}
i = 0

def loadfile():
  filename = ''
  zip_ref = False
  if (len(sys.argv) > 1):
    file = sys.argv[1]
  else:
    for root, dirs, files in os.walk("."):
      for filename in files:
        if filename[-6:] == '.xmind':
          file = filename
          break

  if not file:
    print('no xmind file found!')
  else:
    try:
      zip_ref = zipfile.ZipFile(file, 'r')
    except:
      print('file not found!')

  if zip_ref:
    try:
      zip_ref.extract('content.xml')
      print('xml extracted')
      return True
    except:
      print('no valid xmind file!')
      return False
  else:
    return False
    
def papagoParse(topic, parent):
  global i
  id = i
  obj = {'label' : topic[0].text, 'options' : [], 'parent' : ''}
  for child in topic[1][0]:
    option = {'option' : child[0].text}
    for grandChild in child[1][0]:
      if grandChild[0].text[:5] == 'Fiche':
        option['value'] = grandChild[0].text
      else:
        i += 1
        option['value'] = str(i)
        papagoParse(grandChild, id)
    
      obj['options'].append(option)
  if parent > -1:
    obj['parent'] = str(parent)
  papago[id] = obj
      
if loadfile():
  try: 
    tree = ET.parse('content.xml')
    root = tree.getroot()
    try:
      papagoParse(root[0][0], -1)
      try:
        with open('papago.json', 'w') as json_file:
          json.dump(papago, json_file, indent=4, sort_keys=True)
          print('json file written: papago.json')
      except:
        print('json file could not be written!')
    except:
      print:('parsing error')
  except:
    print('xml error!')

  os.remove('content.xml')
