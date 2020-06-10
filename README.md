Team-Sentry Backend task with PHP

A dockerized micro-service for managing static, external pages
	- add_page
	- retrieve_page_html
	- set_page_markdown
	- list_pages

* ADD PAGE

To add a page, the url(server/api/add_page) accepts a POST request with two values with key: page_name and file_content.
If request is successful it returns json object with a response message the telling you that the file was added successfully. Else it returns a json object error code with the apprpriate error message.


* RETRIEVE PAGE 

To retrieve a page, the url(server/api/retrieve_page) accepts a GET request with one value with key: page_name
If the file exists it returns a json object containing the file content.

* SET PAGE MARKDOWN

To retrieve a page in markdown format, the uri(server/api/set_page_markdown) accepts  request with one value with key: page_name.
If the file exists, it returns the contents of the file in markdown format in the body of a json object. Else, it returns the appropriate error code and response message.

* TO LIST PAGES
To view a list of available pages, a GET request to the uri(server/api/list_pages) returns a json object containing the list of files.
