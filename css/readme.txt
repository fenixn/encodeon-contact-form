/* //////// /////// ////// ///// //// /// // /
    Author: Phuong Nguyen
    Email: artphuong@live.com
////// ///// //// /// // // // /// //// ///// */

SASS is used to write the CSS for this project. It is a language that extends CSS, and allows for variables and other functions. Compass is used to process .scss files to .css files. 

To run Compass, you need to install Ruby on your machine. Then you can install Compass. To use Compass, make sure your Terminal or Command Prompt has Ruby functions. Then navigate to the css folder in Terminal or Command Prompt. It is the folder where the config.rb file is stored. Then type the 'compass watch' command. Compass will watch files in the /sass folder for changes. When you edit and save a .scss file in the /sass folder, it will process it into a .css file and store it in the /stylesheets folder. The functions.php file for this theme reads the .css file form the /stylesheets folder.

When using Compass to compile for production, you need to set the output to compressed. For Compass v1.01, the command is:

compass watch --output-style comprssed

or the shorter option:

compass watch -s compressed

The options may change for later version. Try typing compass watch -h to see all the optiosn and find the one that will compress the .scss to minimize the size of the end .css file.

If you are going to edit the CSS, make sure to edit it through the .scss files and use Compass to process them into .css files. This keeps the process consistent for future developers.