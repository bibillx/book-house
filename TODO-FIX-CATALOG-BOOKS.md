# Fix: Books added in admin not showing in user catalog

**Status: In Progress**

## Steps:
1. [x] Add 'book_type' to Book model $fillable
2. [x] Add status filter to BooksController@catalog()
3. [x] Clear caches
4. [x] Fixed catalog.blade.php JS double storage path causing cover 404/placeholder
5. [ ] Test: Add new book admin → catalog hard refresh → covers show
6. [x] Covers work in detail/admin (confirmed)

**Root cause**: 
- Model missing 'book_type' fillable
- Catalog API filters status='available'

