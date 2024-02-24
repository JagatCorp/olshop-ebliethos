<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $selectedSort = null;

    public function index(Request $request)
    {
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        $products = Product::active();
        $colors = AttributeOption::whereHas(
            'attribute',
            function ($query) {
                $query->where('code', 'color')
                    ->where('is_filterable', 1);
            }
        )
            ->orderBy('name', 'asc')->get();
        $sizes = AttributeOption::whereHas(
            'attribute',
            function ($query) {
                $query->where('code', 'size')
                    ->where('is_filterable', 1);
            }
        )->orderBy('name', 'asc')->get();
        $categories = Category::parentCategories()
            ->orderBy('name', 'asc')
            ->get();

        $selectedSort = url('products');
        // Jika query parameter sort adalah popularity-desc, maka sort by produk terlaris
        if ($request->query('sort') === 'popularity-desc') {
            // Ambil ID produk yang paling sering dipesan dari model Order
            $popularProductIds = Order::where('payment_status', 'PAID')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select('order_items.product_id')
                ->groupBy('order_items.product_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(10) // Ambil 10 produk teratas
                ->pluck('order_items.product_id');

            // Urutkan produk berdasarkan popularitas (penjualan terlaris)
            $products->orderByRaw('FIELD(id, ' . $popularProductIds->implode(',') . ') DESC');
        }

        $sorts = [
            url('products') => 'Bawaan',
            url('products?sort=popularity-desc') => 'Produk Terlaris',
            url('products?sort=price-asc') => 'Harga - Rendah Ke Tinggi',
            url('products?sort=price-desc') => 'Harga - Tinggi Ke Rendah',
            url('products?sort=created_at-desc') => 'Terbaru hingga Terlama',
            url('products?sort=created_at-asc') => 'Terlama hingga Terbaru',
        ];

        $products = $this->_searchProducts($products, $request);

        $products = $this->_filterProductsByPriceRange($products, $request);
        $products = $this->_filterProductsByAttribute($products, $request);
        $products = $this->_sortProducts($products, $request);
        $selectedSort = $this->selectedSort;
        $products = $products->get();

        $productImages = ProductImage::get();

        // Ambil rata-rata nilai ulasan untuk setiap produk
        foreach ($products as $product) {
            $product->average_rating = Review::where('product_id', $product->id)->avg('rating');
        }

        return view('frontend.products.index', compact('products', 'colors', 'sizes', 'minPrice', 'maxPrice', 'categories', 'sorts', 'selectedSort', 'productImages'));
    }
    public function specialDeal(Request $request)
    {
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        $products = Product::active();
        $colors = AttributeOption::whereHas(
            'attribute',
            function ($query) {
                $query->where('code', 'color')
                    ->where('is_filterable', 1);
            }
        )
            ->orderBy('name', 'asc')->get();
        $sizes = AttributeOption::whereHas(
            'attribute',
            function ($query) {
                $query->where('code', 'size')
                    ->where('is_filterable', 1);
            }
        )->orderBy('name', 'asc')->get();
        $categories = Category::parentCategories()
            ->orderBy('name', 'asc')
            ->get();

        $selectedSort = url('products');
        if ($request->query('sort') === 'popularity-desc') {
            // Ambil ID produk yang paling sering dipesan dari model Order
            $popularProductIds = Order::where('payment_status', 'PAID')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->select('order_items.product_id')
                ->groupBy('order_items.product_id')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(10) // Ambil 10 produk teratas
                ->pluck('order_items.product_id');

            // Urutkan produk berdasarkan popularitas (penjualan terlaris)
            $products->orderByRaw('FIELD(id, ' . $popularProductIds->implode(',') . ') DESC');
        }

        $sorts = [
            url('products') => 'Bawaan',
            url('products?sort=popularity-desc') => 'Produk Terlaris',
            url('products?sort=price-asc') => 'Harga - Rendah Ke Tinggi',
            url('products?sort=price-desc') => 'Harga - Tinggi Ke Rendah',
            url('products?sort=created_at-desc') => 'Terbaru hingga Terlama',
            url('products?sort=created_at-asc') => 'Terlama hingga Terbaru',
        ];

        $products = $this->_searchProducts($products, $request);
        $products = $this->_filterProductsByPriceRange($products, $request);
        $products = $this->_filterProductsByAttribute($products, $request);
        $products = $this->_sortProducts($products, $request);
        $selectedSort = $this->selectedSort;
        $products = $products->get();
        $productImages = ProductImage::get();
        // Ambil rata-rata nilai ulasan untuk setiap produk
        foreach ($products as $product) {
            $product->average_rating = Review::where('product_id', $product->id)->avg('rating');
        }
        return view('frontend.products.specialdeal', compact('products', 'colors', 'sizes', 'minPrice', 'maxPrice', 'categories', 'sorts', 'selectedSort', 'productImages'));
    }
    private function _filterProductsByPriceRange($products, $request)
    {
        $lowPrice = null;
        $highPrice = null;

        if ($priceSlider = $request->query('price')) {
            $prices = explode('-', $priceSlider);

            $lowPrice = (float) $prices[0];
            $highPrice = (float) $prices[1];

            if ($lowPrice && $highPrice) {
                $products = $products->where('price', '>=', $lowPrice)
                    ->where('price', '<=', $highPrice)
                    ->orWhereHas(
                        'variants',
                        function ($query) use ($lowPrice, $highPrice) {
                            $query->where('price', '>=', $lowPrice)
                                ->where('price', '<=', $highPrice);
                        }
                    );
            }
        }

        return $products;
    }

    private function _searchProducts($products, $request)
    {
        if ($q = $request->query('q')) {
            $q = str_replace('-', ' ', Str::slug($q));

            $products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

            $this->data['q'] = $q;
        }

        if ($categorySlug = $request->query('category')) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            $childIds = Category::childIds($category->id);
            $categoryIds = array_merge([$category->id], $childIds);

            $products = $products->whereHas(
                'categories',
                function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                }
            );
        }

        return $products;
    }

    private function _filterProductsByAttribute($products, $request)
    {
        if ($attributeOptionID = $request->query('option')) {
            $attributeOption = AttributeOption::findOrFail($attributeOptionID);

            $products = $products->whereHas(
                'ProductAttributeValues',
                function ($query) use ($attributeOption) {
                    $query->where('attribute_id', $attributeOption->attribute_id)
                        ->where('text_value', $attributeOption->name);
                }
            );
        }

        return $products;
    }

    private function _sortProducts($products, $request)
    {
        if ($sort = preg_replace('/\s+/', '', $request->query('sort'))) {
            $availableSorts = ['price', 'created_at'];
            $availableOrder = ['asc', 'desc'];
            $sortAndOrder = explode('-', $sort);

            $sortBy = strtolower($sortAndOrder[0]);
            $orderBy = strtolower($sortAndOrder[1]);

            if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
                $products = $products->orderBy($sortBy, $orderBy);
            }

            $this->selectedSort = url('products?sort=' . $sort);
        }

        return $products;
    }

    public function show(Product $product)
    {
        if (!$product->configurable()) {
            $reviews = Review::where('product_id', $product->id)->paginate(3);

            return view('frontend.products.show', compact('product', 'reviews'));
        }

        $colors = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
        $sizes = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        $reviews = Review::where('product_id', $product->id)->paginate(3);
        return view('frontend.products.show', compact('product', 'sizes', 'colors', 'reviews'));
    }

    public function quickView(Product $product)
    {
        if (!$product->configurable()) {
            return view('frontend.products.quick_view', compact('product'));
        }

        $colors = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
        $sizes = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        return view('frontend.products.quick_view', compact('product', 'sizes', 'colors'));
    }

}
