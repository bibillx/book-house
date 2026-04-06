# Beli Sekarang (Buy Now) Fix

## Steps:
- [x] 1. Add route POST /checkout/buynow in routes/web.php
- [ ] 2. Add buyNow(Request $request) in CheckoutController.php: clear cart, create single cart item from request, redirect checkout
- [ ] 3. Fix book-detail.blade.php form action=route('checkout.buynow') method=POST @csrf + hidden fields from $book
- [ ] 4. Test: book detail → Beli Sekarang → checkout with 1 item → process OK

**Status:** Route ready. Next controller method.
