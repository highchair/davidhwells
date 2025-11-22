David H Wells
=============

## A custom photography portfolio WordPress theme

Design and programming by J. Hogue @ Highchair designhaus

## Built with SASS

Watch command: 
```sh
$ cd ~/WORK/David\ H\ Wells/_www/wp-content/themes/davidhwells/
$ sass --watch sass:stylesheets --style compressed
or
$ sass sass/davidhwells.scss:stylesheets/davidhwells.css --style compressed
```

## Install Dependencies

If you are going to compile locally or on the server, you will need to add the dependencies _Bourbon_ and _Neat_:

```sh
# You already have SASS installed, right? 
$ which sass

# You should see a path to your local SASS copy
# Not there? Install it:
$ sudo gem install sass

# Requires Sass 3.3+
$ sass --v
$ Sass 3.4.20

# Old version? Update!
$ sudo gem update sass

# Never installed Bourbon or Neat? Install their gems first.
$ sudo gem install bourbon
$ sudo gem install neat

# Then, navigate to the directory to install Bourbon into
$ cd /path/to/this/libraries
$ bourbon install
$ neat install
```

Borrowed code from:
* WordPress 2015 Theme
* Zyra theme from Progression studios

Designed and built in 2016
