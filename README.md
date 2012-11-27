For Firefall Players
====================
What is Arcfolder?
------------------
Arcfolder is an open-source repository software for Firefall addons and addon libraries.

Arcfolder is written in PHP, uses a MySQL database, and outputs in XML format. It's structure is loosely derived from the Debian repository system.

What are the goals of the Arcfolder project?
--------------------------------------------
* To create an enduring & flexible standard for Firefall addon/library distribution
* To, through the use of a compatible client, make Firefall addons more accessible
* To make it easier for addon authors to get their addon to the users computer without needing to provide support for basic things such as proper installation procedure

Arcfolder Clients
-----------------
* In development
 * RadthorDax's Melder [[link](http://www.firefallthegame.com/community/threads/addon-manager-melder.52327/)]

----------

For Arcfolder Client Developers
===============================
What kinds of files does an Arcfolder repository use?
-----------------------------------------------------
Arcfolder only accepts `.zip` files for packages. This is to ensure compatibility with any client. All package data is stored in `.xml`'s.
How do I read the addons/libraries database?
--------------------------------------------
Within Arcfolder, uploads are referred to as 'packages', which are stored under `./public/packages/`. Packages are split into two categories: addons (`./public/packages/addons/`) and libraries (`./arcfolder/packages/libraries/`). Packages are named based on the project name and the version. Information for packages is stored in an XML file named identically to the associated package, except for the `.xml` file extension instead of `.zip`.

For clients that are unable to recur into directories accessed over HTTP, manifests listing packages are generated at `./public/manifest_addons.xml` and `./public/manifest_libraries.xml`. These list package_name-version combinations, as it is assumed that any client will be designed with an understanding of Arcfolder. If `./public/manifest_addons.xml` lists `example_addon-0.8.3.0`, the package will be found at `./public/packages/addons/example_addon-0.8.3.0.zip`, and the XML containing the package information will be found at `./public/xml/addons/example_addon-0.8.3.0.xml`.