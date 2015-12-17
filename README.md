# Unnamed-Forum-Software
This software was developed out of the fact that there are no really good and open forum softwares, where you easily can do some things.

## Prerequisites
#### Required
* PHP 5.6+
* (MySQL?)
* mod_rewrite (Apache2)

#### Optional, But recommended
* Ubuntu

## Installation
1. Download the latest version.
2. Create a folder and unzip the latest version in there.
3. Do A: Follow the optional steps below OR B: Point the DocumentRoot to the "/path/to/website/forums/public_html" directory
4. Profit? Profit!


* (Optional: Copy the site.apache2 file to /etc/apache2/sites-enabled/ & restart apache2)

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
    config.php
    pagehandler.php
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
