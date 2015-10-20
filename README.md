# Laravel 5 pagination wrapper

Custom pagination wrapper with Form Select and Zurb Foundation implementations.

## Preview

#### Desktop

![Pagination on Desktop](/assets/images/desktop.jpg?raw=true "Pagination on Desktop")

#### Smart Phone

![Pagination on Smart Phone](/assets/images/smart-phone.jpg?raw=true "Pagination on Smart Phone")

#### Select functionality

For the select to work with the pagination - use [ssdSelectHref jQuery plugin](https://github.com/sebastiansulinski/ssd-href-select)

------

## Usage

From within your controller's method use the `pagination()` method as you would with the default pagination.

```
public function index()
{
    $collection = Product::latest()->paginate(12);

    return $this->view('product.index', compact('collection'));
}
```

In the view wrap the collection with one of the pagination wrappers

```
{!! (new \SSD\Pagination\Select($collection))->render() !!}
```

or

```
{!! (new \SSD\Pagination\Foundation($collection))->render() !!}
```

To center pagination on the page use the div with class `pagination-center` (this will only work if you used the attached scss file to render your styles)

```
<div class="pagination-center">
    {!! (new \SSD\Pagination\Select($collection))->render() !!}
</div>
```

```
<div class="pagination-center">
    {!! (new \SSD\Pagination\Foundation($collection))->render() !!}
</div>
```