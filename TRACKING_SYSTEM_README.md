# Order Tracking System - Avflowril

## Overview
Sistem pelacakan pesanan yang telah diperbarui dengan fitur auto-update dan tampilan yang lebih informatif.

## Fitur Baru

### 1. Auto-Update Tracking
- **Real-time Updates**: Tracking otomatis diperbarui setiap 30 detik di halaman tracking
- **Progressive Status**: Status pesanan berkembang secara otomatis berdasarkan waktu dan kondisi pembayaran
- **Background Processing**: Update tracking berjalan di background tanpa mengganggu user experience

### 2. Enhanced Tracking Display
- **Timeline View**: Tampilan timeline yang lebih informatif dengan ikon status
- **Metadata Support**: Menampilkan informasi tambahan seperti nomor resi, kurir, estimasi pengiriman
- **Copy Tracking Number**: Fitur copy nomor resi dengan satu klik
- **Auto-refresh Indicator**: Indikator visual untuk status auto-refresh

### 3. Realistic Tracking Progression
- **Pesanan Diterima** → **Bukti Pembayaran Diunggah** → **Pembayaran Dikonfirmasi** → **Sedang Diproses** → **Dikemas** → **Dikirim** → **Dalam Perjalanan** → **Diterima**

## Status Tracking

### Status yang Tersedia:
1. **pending** - Pesanan diterima, menunggu pembayaran
2. **payment_uploaded** - Bukti pembayaran telah diunggah
3. **confirmed** - Pembayaran dikonfirmasi
4. **processing** - Pesanan sedang diproses
5. **packed** - Pesanan telah dikemas
6. **shipped** - Pesanan dikirim
7. **out_for_delivery** - Dalam perjalanan pengiriman
8. **delivered** - Pesanan diterima
9. **cancelled** - Pesanan dibatalkan

## Auto-Update Logic

### Progression Rules:
- **pending** → **confirmed**: Otomatis setelah payment_status = 'paid'
- **confirmed** → **processing**: Setelah 1 jam
- **processing** → **packed**: Setelah 2-4 jam
- **packed** → **shipped**: Setelah 1-2 jam
- **shipped** → **out_for_delivery**: Setelah 1-3 hari
- **out_for_delivery** → **delivered**: Setelah 2-6 jam

## Commands

### 1. Update Tracking (Auto)
```bash
php artisan orders:update-tracking
```
Update semua pesanan yang belum selesai

### 2. Update Specific Order
```bash
php artisan orders:update-tracking --order-number=ORD-20250708-8A30FB
```

### 3. Add Realistic Tracking Data
```bash
php artisan orders:add-realistic-tracking ORD-20250708-8A30FB
```
Menambahkan data tracking realistis untuk testing

## Scheduled Tasks

### Auto-Update Schedule:
- **Frequency**: Setiap 5 menit
- **Command**: `orders:update-tracking`
- **Background**: Ya
- **Overlap Protection**: Ya

Untuk mengaktifkan scheduled tasks:
```bash
php artisan schedule:work
```

## API Endpoints

### 1. Tracking API
```
GET /api/tracking/{orderNumber}
```
Response:
```json
{
  "order_number": "ORD-20250708-8A30FB",
  "status": "shipped",
  "status_label": "Dikirim",
  "total_amount": "Rp 370.000",
  "created_at": "08 Jul 2025, 13:56",
  "tracking": [
    {
      "status": "shipped",
      "title": "Pesanan Dikirim",
      "description": "Pesanan Anda telah dikirim melalui AnterAja dengan nomor resi: SC352656425",
      "location": "Sorting Center Jakarta",
      "tracked_at": "08 Jul 2025, 20:47",
      "icon": "fa-truck",
      "color": "info",
      "metadata": {
        "courier": "AnterAja",
        "tracking_number": "SC352656425",
        "estimated_delivery": "2025-07-11"
      }
    }
  ]
}
```

### 2. Test Update API
```
GET /test/update-tracking/{orderNumber}
```

## Frontend Features

### 1. Auto-Refresh
- Refresh setiap 30 detik untuk pesanan yang belum selesai
- Visual indicator dengan animasi
- Otomatis berhenti untuk pesanan yang sudah delivered/cancelled

### 2. Copy Tracking Number
- Button copy di sebelah nomor resi
- Toast notification untuk feedback
- Visual feedback pada button

### 3. Enhanced Timeline
- Reverse chronological order (terbaru di atas)
- Status-specific colors dan icons
- Metadata display untuk informasi tambahan
- Location information

## Files Modified/Created

### New Files:
1. `app/Services/OrderTrackingService.php` - Service untuk auto-update logic
2. `app/Console/Commands/UpdateOrderTracking.php` - Command untuk update tracking
3. `app/Console/Commands/AddRealisticTracking.php` - Command untuk testing data

### Modified Files:
1. `app/Http/Controllers/OrderTrackingController.php` - Auto-update integration
2. `app/Models/OrderTracking.php` - Enhanced status icons dan colors
3. `resources/views/orders/tracking.blade.php` - Enhanced UI dan auto-refresh
4. `app/Providers/AppServiceProvider.php` - Command registration dan scheduling
5. `routes/web.php` - Test routes

## Testing

### 1. Test Order: ORD-20250708-8A30FB
- Status: shipped
- Tracking entries: 6
- Auto-update: Active

### 2. Access URLs:
- Tracking Page: `http://127.0.0.1:8000/tracking/ORD-20250708-8A30FB`
- API: `http://127.0.0.1:8000/api/tracking/ORD-20250708-8A30FB`
- Test Update: `http://127.0.0.1:8000/test/update-tracking/ORD-20250708-8A30FB`

## Browser Compatibility
- Modern browsers dengan JavaScript enabled
- Clipboard API support untuk copy functionality
- CSS Grid dan Flexbox support

## Performance Considerations
- Auto-refresh hanya untuk pesanan aktif
- Background AJAX calls
- Minimal DOM manipulation
- Efficient database queries dengan eager loading

## Security
- User authorization check untuk private orders
- CSRF protection pada API calls
- Input validation pada commands
- Safe JSON encoding untuk metadata