# NovuForum
This software was developed out of the fact that there are no really good and open forum softwares, where you easily can do some things.

## Prerequisites
#### Required
* PHP 5.6+
* a MySQL Database + php5_json
* mod_rewrite (Apache2)

#### Optional, But recommended
* Ubuntu

## Installation
1. Download the latest version.
2. Create a folder and unzip the latest version in there.
3. Make sure that the folder has correct permissions so that NovuForum can read/write files inside that folder!
5. Profit? Profit!

## Coders
[Joarc](https://www.joarc.se/): Coded websites for many years, just not any projects for public use.

[Ekner](http://xzy.se/): ??

## Code of Conduct
(This is mostly for us coders)

No Tabs, "Tabs" should be 2 spaces.

__Languages:__ HTML, CSS, JS, PHP

__Editor:__ Preferably Atom

__Version Control System:__ Github & Github Windows

#### Directories
###### master, latest
```
forums/
  plugins/
    "PLUGINTUTORIAL"
  includes/
    setup.php
    default.php
    config.php
    pagehandler.php
    pages/
    forms/
    functions/
      mysql.php
      functions.php
      funcs.php
    libraries/
      parsedown/
  public_html/
    index.php
    img/
      favicon.png
      uploaded/ #Uploaded custom images
        uploaded_imgs.png
    css/
      bootstrap.css
      global.css
      forums/ #Per page CSS
        page.css
      custom/ #Override things in global.css
        global.css
        page.css
    js/
      bootstrap.js
      jquery.js
```

###### docs
```
TBD
```

###### public
```
TBD
```

###### Branches:
* master: all code is here, push changes here.
* latest: Latest release, download this.
* public: Public website, promote project.
* docs: Documentation website,

## Planned Features
- Simple Design
- Simple Modules Feature ("Plugins")
- Simple CSS Modifier
- Simple Manager
- Correct way to manager Moderators, Admins and Others
- Easy way to integrate own pages, websites and other features
- Simple API for integration to own websites
- More Features? Suggest them!
- ~~Name~~

## License
We use MIT License. [Read it HERE](https://github.com/Joarc-SE/NovuForum/blob/master/LICENSE)
