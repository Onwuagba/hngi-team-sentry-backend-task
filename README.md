# Team -Sentry Backend task with PHP

Welcome to the static page generator API created by the PHP people of team-sentry.
<br/>This api will enable you create static pages (markdown and html) , store them for you and you can have them anytime.

All the urls return responses in json format, like so;

```yaml
{
    'message':
        "response payload here"
}
```

## How to use it

The api uses four major endpoints as explained below. <br/>
All request are sent to;

```yaml
http://server-url/api/
```

### To upload a markdowm file

To upload a markdown file, send a POST request to;

```yaml
http://server-url/api/add_page?file=file-here
```

If you dont have a markdown file we can create one for you by specifying a file titile and it's contents like so;

```yaml
http://server-url/api/add_page?page_title=page-title-here&page_content=page-content-here
```

We shall create the file for you and keep for you.

### To write to a file

If you have a file with us already, send a POST request to this endpoint specifying the title and the content you want to write and it shall be done;

```yaml
http://server-url/api/set_page_markdown?page_title=page-title-here&page_content=page-content-here
```

### To get html

To get the html equivalent of your markdown file, send a GET request to this endpoint to get your html. The page title must be set.

```yaml
http://server-url/api/retrieve_page_html?page_title=page-title-here
```

### To get markdown

To get the markdown text, send a GET request to this endpoint. The page title must be set.

```yaml
http://server-url/api/retrieve_page_markdown?page_title=page-title-here
```

### To get a list of pages stored with us

Send a GET request to this endpoint to get a list of all the pages you have stored with us;

```yaml
http://server-url/api/list_pages
```

## Errors

If any of the responses are not successful, it means there was problem and it will be indicated in the *errors* key of the json response, like so;

```yaml
{
    'errors':
        "error response here"
}
```
