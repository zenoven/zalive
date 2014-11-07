### 1.3.4 ###
* better editor style

### 1.3.3 ###
* add editor style support
* better style for default table in post content (remove the default 100% width, if you want it 100% percent just add class 'full-width' to the table )
* better font-family for slider title

### 1.3.2 ###
* update license info

### 1.3.1 ###
* fix header dropdown menu bug when no menu is set up in WordPress Admin > Appearance > Menus( by changing wp_list_categories parameter depth to 1)
* better font-family for heading tags

### 1.3 ###
* rewrite top nav bar with better performance and friendly interaction(on mobile device).
* first level menu item with sub menu in top nav now is clickable.
* set sidebar comment widget width automatically with CSS(replace the old JS solution)

### 1.2.12 ###
* add French translation(thanks to Geek01).

### 1.2.11 ###
* fix the bug that slider and secondary-sidebar showing on blog post page(not homepage) even the setting is 'Enable in Home Page'. 

### 1.2.10 ###
* add 'Read More' link for custom excerpt by modifying functions and filters. 
* optimize mobile platform CSS styles.

### 1.2.9 ###
* update Russian translation.

### 1.2.8 ###
* add option for changing slider pause time.
* fix slider content can't be empty bug.

### 1.2.7 ###
* optimize pagination style in mobile platform and the case that there are many links.

### 1.2.6 ###
* fix dropdown menu height bug in IE 10 and 11.
* optimize pagination CSS style.

### 1.2.5 ###
* make the option 'Text for "Read More"' in effect when 'more' tag is used in posts.
* fix the arguments of wp_list_pages in footer.php(thanks to navillus0).
* add more social media links to the Social Links widget.

### 1.2.4 ###
* replace GMT time with local time in custom recent comments widget.
* optimize the icon position in sticky post title( in case there are more than one line of text in title).
* add Russian translation(thanks to Aleksey Maksimov).

### 1.2.3 ###
* fix some translation bugs.
* optimize some textarea style in theme options page.

### 1.2.2 ###
* optimize the style of post content.
* optimize the style.css with better selectors, coding style and well comments.
* add style for pages like: password protected page, 404.php, content-none.php and more.
* add many theme options like: excerpt,primary sidebar layout, swithes(tagline,searchbox,breadcrumb and more), CSS code,scripts. 
* add support for custom background. 
* add zAlive.pot in /languages and may be useful for translator.
* rewrite custom widgets with better security.
* providing better content pagination and comment pagination by using new functions or arguments.
* replace footer widgets with secondary sidebar so that you can custom it with widgets you want.
* organize php files with better file structure and naming(rename many php files or move them to sub folders)
* remove GuestWall page template(as it may cause security issues)   

### 1.2.1 ###
* add filter for wp_title.

### 1.2.0 ###
* change arguments in wp_list_categories and wp_list_pages to hide unnecessary levels of menu.
* add some default widgets incase sidebar is left as blank.
* replace title.php with usage of wp_title.

### 1.1.10 ###
* fix sub-menu dropdown bugs on mobile platform.

### 1.1.9 ###
* fix sub-menu not showing on hover event.
* update twitter-bootstrap-hover-dropdown plugin with a new version.

### 1.1.8 ###
* replace sharing code with advertisement code

### 1.1.7 ###
* optimize the format of date before the post(according to the user-selected date format rather than hard-coded).
* escape all home_url() calls.

### 1.1.6 ###
* use jQuery that WordPress bundled rather than a theme customed one.
* optimize the default value in theme option page.

### 1.1.5 ###
* fix double title bugs.

### 1.1.4 ###
* add search widget.

### 1.1.3 ###
* change license from GPL v2 to GPL v3.

### 1.1.2 ###
* remove translation for theme options default value.

### 1.1.1 ###
* better security and more effective for set/get theme options.
* some translation bugs fixed.
* enqueue all stylesheets and scripts by using wp_enqueue_style() and wp_enqueue_script() in theme option page.

### 1.0.9 ###
* add readme.txt file.
* replace hard coded credit link with esc_url function.
* replace 4 slider images with more beautiful ones.
* optimize styles for 'code' markup.

### 1.0.8 ###
* some translation bugs fixed.
* add styles for 'code' markup.

### 1.0.7 ###
* balance the height of #main and #sidebar with CSS rather than JS.
* add header-no-sidebar.php so that we can use it in other template.
* add page-no-sidebar.php so that we can post a page by selecting 'No Sidebar' page template.

### 1.0.3 ###
* remove one credit link in the footer.
* enqueue all stylesheets and scripts by using wp_enqueue_style() and wp_enqueue_script()
* some translation bugs fixed.
* add translation for all public-facing text strings in Javascript.

### 1.0 ###
* Theme uploaded.