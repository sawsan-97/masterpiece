<!-- Product Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <a href="{{ route('home') }}" class="btn-close ms-0 me-auto" aria-label="إغلاق"></a>
            </div>
            <div class="modal-body py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-quick-image">
                                <img src="" id="quickViewImage" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <h3 class="product-quick-title mb-3" id="quickViewTitle"></h3>
                            <p class="product-quick-price mb-3" id="quickViewPrice"></p>
                            <div class="product-quick-description mb-4" id="quickViewDescription"></div>
                            <div class="product-quick-stock mb-3" id="quickViewStock"></div>
                            <form action="" id="quickViewCartForm" method="POST">
                                @csrf
                                <div class="d-flex justify-content-end align-items-center gap-3 mb-4">
                                    <label for="quantity" class="mb-0">الكمية:</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-sm text-center" value="1" min="1" style="width: 80px">
                                </div>
                                <div class="d-flex gap-2 justify-content-end">
                                    @php
                                        $modalStock = isset($product) ? $product->stock : null;
                                    @endphp
                                    @if(isset($product) && $product->stock == 0)
                                        <button type="button" class="btn btn-secondary px-4" disabled>غير متوفر</button>
                                    @else
                                        <button type="submit" class="btn btn-gold px-4">أضف للسلة</button>
                                    @endif
                                    <a href="{{ route('home') }}" class="btn btn-outline-gold">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-quick-image {
    border-radius: 8px;
    overflow: hidden;
    height: 400px;
}

.product-quick-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-quick-title {
    font-size: 24px;
    font-weight: 600;
    color: #333;
}

.product-quick-price {
    font-size: 22px;
    font-weight: 600;
    color: rgba(255, 191, 0, 1);
}

.product-quick-description {
    color: #666;
    line-height: 1.6;
}

.product-quick-stock {
    font-weight: 500;
}

.product-quick-stock.in-stock {
    color: #28a745;
}

.product-quick-stock.out-of-stock {
    color: #dc3545;
}

.modal-header .btn-close {
    padding: 0.5rem;
}

.form-control {
    border-radius: 6px;
}

.add-to-wishlist {
    padding: 0.5rem;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.add-to-wishlist.active {
    background-color: rgba(255, 191, 0, 1);
    border-color: rgba(255, 191, 0, 1);
    color: white;
}
</style>
