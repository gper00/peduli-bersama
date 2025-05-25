<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Donasi #{{ $donation->invoice_number }} - Peduli Bersama</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            color: #374151;
            margin: 0;
            padding: 20px;
            background-color: #f3f4f6;
        }
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .receipt-header {
            background-color: #1e40af;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .receipt-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .receipt-header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .receipt-body {
            padding: 30px;
        }
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .receipt-info-section {
            flex: 1;
        }
        .receipt-info-section h2 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 10px;
            color: #4b5563;
        }
        .receipt-info-section p {
            margin: 5px 0;
            font-size: 14px;
        }
        .receipt-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .receipt-details th {
            background-color: #f3f4f6;
            text-align: left;
            padding: 12px 15px;
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
        }
        .receipt-details td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }
        .receipt-total {
            text-align: right;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 600;
        }
        .receipt-total span {
            font-size: 20px;
            color: #1e40af;
            margin-left: 10px;
        }
        .receipt-footer {
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        .receipt-footer p {
            margin: 5px 0;
        }
        .receipt-footer .contact {
            margin-top: 10px;
        }
        .receipt-footer .contact a {
            color: #1e40af;
            text-decoration: none;
        }
        .receipt-note {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 20px;
        }
        .receipt-stamp {
            margin-top: 30px;
            text-align: right;
        }
        .receipt-stamp .stamp {
            border: 2px dashed #1e40af;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 6px;
            color: #1e40af;
            font-weight: 600;
            transform: rotate(-5deg);
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .receipt-container {
                box-shadow: none;
                max-width: 100%;
            }
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">Cetak Kuitansi</button>
    
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Kuitansi Donasi</h1>
            <p>Peduli Bersama - Platform Donasi untuk Indonesia</p>
        </div>
        
        <div class="receipt-body">
            <div class="receipt-info">
                <div class="receipt-info-section">
                    <h2>Informasi Donasi</h2>
                    <p><strong>No. Invoice:</strong> {{ $donation->invoice_number }}</p>
                    <p><strong>Tanggal:</strong> {{ $donation->payment_date ? $donation->payment_date->format('d M Y, H:i') : $donation->updated_at->format('d M Y, H:i') }}</p>
                    <p><strong>Status:</strong> Berhasil</p>
                    <p><strong>Metode Pembayaran:</strong> {{ ucwords(str_replace('_', ' ', $donation->payment_method)) }}</p>
                </div>
                
                <div class="receipt-info-section">
                    <h2>Informasi Donatur</h2>
                    <p><strong>Nama:</strong> {{ $donation->getDonorNameAttribute() }}</p>
                    <p><strong>Email:</strong> {{ $donation->donor_email }}</p>
                    @if($donation->donor_phone)
                    <p><strong>Telepon:</strong> {{ $donation->donor_phone }}</p>
                    @endif
                </div>
            </div>
            
            <table class="receipt-details">
                <thead>
                    <tr>
                        <th width="60%">Deskripsi</th>
                        <th width="20%">Campaign</th>
                        <th width="20%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p><strong>Donasi untuk {{ $donation->campaign->title }}</strong></p>
                            <p style="font-size: 13px; color: #6b7280;">{{ Str::limit($donation->campaign->short_description, 100) }}</p>
                            @if($donation->message)
                            <p style="font-style: italic; font-size: 13px; color: #6b7280;">Pesan: "{{ $donation->message }}"</p>
                            @endif
                        </td>
                        <td>{{ $donation->campaign->user->name }}</td>
                        <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="receipt-total">
                Total Donasi: <span>Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
            </div>
            
            <div class="receipt-note">
                <p><strong>Catatan:</strong> Kuitansi ini adalah bukti resmi dari donasi yang telah dilakukan melalui platform Peduli Bersama. Terima kasih atas dukungan dan kepercayaan Anda.</p>
            </div>
            
            <div class="receipt-stamp">
                <div class="stamp">LUNAS</div>
            </div>
        </div>
        
        <div class="receipt-footer">
            <p>Donasi ini akan digunakan sesuai dengan tujuan campaign yang telah ditetapkan.</p>
            <p>© {{ date('Y') }} Peduli Bersama. Hak Cipta Dilindungi.</p>
            <div class="contact">
                <p>Pertanyaan? Hubungi kami di <a href="mailto:support@pedulibersama.org">support@pedulibersama.org</a></p>
            </div>
        </div>
    </div>
</body>
</html>
