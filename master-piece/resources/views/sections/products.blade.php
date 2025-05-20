@if(isset($title))
    <h2 class="section-title mb-4">{{ $title }}</h2>
@endif

@if(session('success'))

@endif

<div class="row mb-5">
    @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100">
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="product-actions">
                        <button type="button"
                                class="btn btn-light btn-sm quick-view"
                                data-bs-toggle="modal"
                                data-bs-target="#quickViewModal"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-price="{{ number_format($product->price, 2) }}"
                                data-product-description="{{ $product->description }}"
                                data-product-image="{{ $product->image ? asset($product->image) : asset('images/placeholder.jpg') }}"
                                data-product-stock="{{ $product->stock }}"
                                data-cart-url="{{ route('cart.add', $product) }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                    @if($product->sale_price)
                        <p class="product-price mb-2">
                            <span class="text-decoration-line-through text-muted">{{ number_format($product->price, 2) }} د.ك</span>
                            <br>
                            <span class="text-danger">{{ number_format($product->sale_price, 2) }} د.ك</span>
                        </p>
                    @elseif($product->price)
                        <p class="product-price mb-2">{{ number_format($product->price, 2) }} د.ك</p>
                    @endif
                </div>
                <div class="card-footer bg-white border-0 pb-3 text-center">
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        @if($product->stock > 0)
                            <button type="submit" class="btn btn-gold px-4">أضف للسلة</button>
                        @else
                            <button type="button" class="btn btn-secondary px-4" disabled>غير متوفر</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                لا توجد منتجات في هذا القسم حالياً
            </div>
        </div>
    @endforelse
</div>

@include('components.product-quick-view')

<style>
.product-card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    height: 250px;
    overflow: hidden;
    position: relative;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.product-description {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.product-price {
    font-size: 18px;
    font-weight: 600;
    color: var(--primary);
}

.btn-primary {
    background-color: var(--primary);
    border: none;
    padding: 8px 25px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.section-title {
    position: relative;
    padding-right: 15px;
    margin-bottom: 30px;
    font-weight: 700;
    color: #333;
}

.section-title::before {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 5px;
    height: 24px;
    background-color: var(--primary);
}

.product-actions {
    position: absolute;
    top: 10px;
    left: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
}

.product-actions .btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 5px;
    transition: all 0.3s ease;
}

.product-actions .btn:hover {
    background-color: rgba(255, 191, 0, 1);
    color: white;
}

.toast-message {
    position: fixed;
    top: 30px;
    right: 30px;
    z-index: 9999;
    background: #28a745;
    color: #fff;
    padding: 18px 22px;
    border-radius: 50%;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    font-size: 2em;
    opacity: 1;
    pointer-events: auto;
    transition: opacity 1s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.toast-message.fadeout {
    opacity: 0;
}
.checkmark {
    font-size: 2em;
    color: #fff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quickViewButtons = document.querySelectorAll('.quick-view');

    quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('quickViewModal');

            // Update modal content
            modal.querySelector('#quickViewImage').src = this.dataset.productImage;
            modal.querySelector('#quickViewTitle').textContent = this.dataset.productName;
            modal.querySelector('#quickViewPrice').textContent = this.dataset.productPrice + ' د.ك';
            modal.querySelector('#quickViewDescription').textContent = this.dataset.productDescription;

            // Update stock status
            const stock = parseInt(this.dataset.productStock);
            const stockElement = modal.querySelector('#quickViewStock');
            stockElement.textContent = stock > 0 ? 'متوفر في المخزون' : 'غير متوفر حالياً';
            stockElement.className = 'product-quick-stock mb-3 ' + (stock > 0 ? 'in-stock' : 'out-of-stock');

            // Update form action
            modal.querySelector('#quickViewCartForm').action = this.dataset.cartUrl;
        });
    });
});
</script>
