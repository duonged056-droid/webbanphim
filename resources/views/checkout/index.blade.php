@extends('layouts.app')

@section('content')
<!-- Toast thông báo -->
<div id="toastContainer" style="position: fixed; top: 1.5rem; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.6rem;"></div>

<div style="max-width: 1100px; margin: 0 auto;">
    <h2 style="font-size: 2rem; color: var(--light); margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">Thanh toán đơn hàng</h2>

    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(239, 68, 68, 0.2);">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        @csrf
        <!-- Ẩn field địa chỉ đầy đủ tổng hợp -->
        <input type="hidden" name="DiaChiGiaoHang" id="DiaChiGiaoHangFull">

        <!-- Cột thông tin -->
        <div style="background: var(--dark-elevated); border: 1px solid var(--border); border-radius: 12px; padding: 2rem;">
            <h3 style="color: var(--light); margin-bottom: 1.5rem;">Thông tin giao hàng</h3>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Họ tên</label>
                <input type="text" value="{{ Auth::user()->name }}" disabled style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: rgba(0,0,0,0.2); color: var(--gray); font-family: inherit; cursor: not-allowed; box-sizing: border-box;">
            </div>

            <!-- Số điện thoại - chỉ nhập số -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Số điện thoại *</label>
                <input
                    type="tel"
                    name="DienThoai"
                    id="DienThoai"
                    required
                    maxlength="11"
                    placeholder="Vd: 0901234567"
                    inputmode="numeric"
                    pattern="[0-9]{9,11}"
                    title="Số điện thoại phải từ 9-11 chữ số"
                    style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                    onfocus="this.style.borderColor='var(--primary)'"
                    onblur="validatePhone(this)"
                    oninput="onPhoneInput(this)"
                >
                <div id="phoneError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; display: none;">Số điện thoại chỉ gồm 9-11 chữ số.</div>
            </div>

            <!-- Địa chỉ giao hàng -->
            <div style="margin-bottom: 1rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Địa chỉ giao hàng *</label>

                <!-- Nút dùng vị trí hiện tại -->
                <button type="button" id="btnGetLocation" onclick="getLocation()" style="display: flex; align-items: center; gap: 0.5rem; background: rgba(99,102,241,0.12); color: var(--primary); border: 1px dashed var(--primary); border-radius: 8px; padding: 0.6rem 1rem; font-size: 0.85rem; cursor: pointer; margin-bottom: 1rem; transition: all 0.2s; font-family: inherit; width: 100%;">
                    <span>📍</span> Sử dụng vị trí hiện tại của tôi
                </button>
                <div style="text-align: center; color: var(--gray); font-size: 0.8rem; margin-bottom: 1rem; position: relative;">
                    <span style="background: var(--dark-elevated); padding: 0 0.5rem; position: relative; z-index: 1;">hoặc nhập địa chỉ thủ công</span>
                    <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--border); z-index: 0;"></div>
                </div>

                <!-- Chọn Tỉnh/TP -->
                <div style="margin-bottom: 0.8rem;">
                    <select id="tinh" onchange="loadHuyen()" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                        <option value="">-- Chọn Tỉnh / Thành phố --</option>
                    </select>
                </div>

                <!-- Chọn Quận/Huyện -->
                <div style="margin-bottom: 0.8rem;">
                    <select id="huyen" onchange="loadXa()" disabled style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box; opacity: 0.6;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                        <option value="">-- Chọn Quận / Huyện --</option>
                    </select>
                </div>

                <!-- Chọn Phường/Xã -->
                <div style="margin-bottom: 0.8rem;">
                    <select id="xa" onchange="updateAddress()" disabled style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box; opacity: 0.6;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                        <option value="">-- Chọn Phường / Xã --</option>
                    </select>
                </div>

                <!-- Địa chỉ chi tiết -->
                <div id="diaChiChiTietWrapper" style="display: none; margin-bottom: 0.8rem;">
                    <input
                        type="text"
                        id="diaChiChiTiet"
                        placeholder="Số nhà, tên đường, tên tòa nhà..."
                        style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;"
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='var(--border)'"
                        oninput="updateAddress()"
                    >
                    <div style="font-size: 0.75rem; color: var(--gray); margin-top: 0.3rem;">Nhập số nhà, đường, tòa nhà... rồi địa chỉ sẽ hiện trên bản đồ</div>
                </div>

                <!-- Hiển thị địa chỉ tổng hợp -->
                <div id="addressPreview" style="display: none; background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.3); border-radius: 8px; padding: 0.7rem 1rem; font-size: 0.85rem; color: var(--light); margin-bottom: 0.8rem;">
                    <span style="color: var(--gray);">📍 Địa chỉ: </span><span id="addressPreviewText"></span>
                </div>
            </div>

            <!-- Bản đồ -->
            <div id="mapWrapper" style="display: none; margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Xác nhận vị trí trên bản đồ</label>
                <div id="map" style="width: 100%; height: 280px; border-radius: 10px; border: 1px solid var(--border); overflow: hidden;"></div>
                <div style="font-size: 0.75rem; color: var(--gray); margin-top: 0.4rem;">Bạn có thể kéo ghim đỏ để điều chỉnh vị trí chính xác hơn.</div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Phương thức thanh toán *</label>
                <select name="PhuongThucThanhToan" required style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                    <option value="Thanh toán khi nhận hàng (COD)">Thanh toán khi nhận hàng (COD)</option>
                    <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                    <option value="Ví điện tử Momo">Ví điện tử Momo/ZaloPay</option>
                </select>
            </div>
        </div>

        <!-- Cột đơn hàng -->
        <div style="background: var(--dark-elevated); border: 1px solid var(--border); border-radius: 12px; padding: 2rem; height: fit-content;">
            <h3 style="color: var(--light); margin-bottom: 1.5rem;">Tóm tắt đơn hàng</h3>

            <div style="margin-bottom: 1.5rem; max-height: 300px; overflow-y: auto; padding-right: 0.5rem;">
                @foreach($cart as $item)
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem; align-items: center;">
                        <img src="{{ (str_starts_with($item['image'], 'http') ? $item['image'] : asset('images/' . $item['image'])) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                        <div style="flex: 1;">
                            <h4 style="color: var(--light); font-size: 0.9rem; margin-bottom: 0.3rem;">{{ $item['name'] }}</h4>
                            <div style="color: var(--gray); font-size: 0.85rem;">Số lượng: {{ $item['quantity'] }}</div>
                        </div>
                        <div style="color: var(--primary); font-weight: bold; font-size: 0.9rem;">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="border-top: 1px solid var(--border); padding-top: 1.5rem; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="color: var(--gray);">Tạm tính</span>
                    <span style="color: var(--light);">{{ number_format($total, 0, ',', '.') }} đ</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="color: var(--gray);">Phí vận chuyển</span>
                    <span style="color: var(--light);">Miễn phí</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed var(--border);">
                    <span style="color: var(--light); font-weight: bold; font-size: 1.1rem;">Tổng cộng</span>
                    <span style="color: var(--primary); font-weight: bold; font-size: 1.5rem;">{{ number_format($total, 0, ',', '.') }} đ</span>
                </div>
            </div>

            <button type="submit" id="submitBtn" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 8px;">Xác nhận đặt hàng</button>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('cart.index') }}" style="color: var(--gray); text-decoration: none; font-size: 0.9rem;">&larr; Quay lại giỏ hàng</a>
            </div>
        </div>
    </form>
</div>

<style>
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--gray); }

    @media (max-width: 768px) {
        form { grid-template-columns: 1fr !important; }
    }

    #btnGetLocation:hover {
        background: rgba(99,102,241,0.2) !important;
    }

    select:disabled { opacity: 0.45; cursor: not-allowed; }
    select:not(:disabled) { opacity: 1; cursor: pointer; }
</style>

<!-- Leaflet Map (không cần API key) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLs=" crossorigin=""></script>

<script>
// ==============================
// BIẾN TOÀN CỤC
// ==============================
let map = null;
let marker = null;
let tinhData = {};

// ==============================
// 1. LOAD DỮ LIỆU TỈNH/HUYỆN/XÃ
// ==============================
async function loadTinh() {
    try {
        const res = await fetch('https://provinces.open-api.vn/api/?depth=1');
        const data = await res.json();
        const select = document.getElementById('tinh');
        data.sort((a,b) => a.name.localeCompare(b.name, 'vi'));
        data.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t.code;
            opt.textContent = t.name;
            select.appendChild(opt);
        });
    } catch(e) {
        console.warn('Không tải được danh sách tỉnh, dùng fallback');
        loadTinhFallback();
    }
}

function loadTinhFallback() {
    const provinces = [
        {code:'01',name:'Hà Nội'},{code:'79',name:'TP. Hồ Chí Minh'},{code:'48',name:'Đà Nẵng'},
        {code:'92',name:'Cần Thơ'},{code:'31',name:'Hải Phòng'},{code:'56',name:'Khánh Hòa'},
        {code:'38',name:'Thanh Hóa'},{code:'40',name:'Nghệ An'},{code:'46',name:'Thừa Thiên Huế'},
        {code:'74',name:'Bình Dương'},{code:'75',name:'Đồng Nai'},{code:'77',name:'Bà Rịa - Vũng Tàu'},
        {code:'60',name:'Gia Lai'},{code:'62',name:'Đắk Lắk'},{code:'89',name:'An Giang'},
        {code:'93',name:'Kiên Giang'},{code:'96',name:'Cà Mau'},{code:'72',name:'Tây Ninh'},
        {code:'80',name:'Long An'},{code:'82',name:'Tiền Giang'},{code:'84',name:'Vĩnh Long'},
        {code:'86',name:'Đồng Tháp'},{code:'87',name:'Hậu Giang'},{code:'66',name:'Đắk Nông'},
        {code:'64',name:'Kon Tum'},{code:'52',name:'Bình Định'},{code:'54',name:'Phú Yên'},
        {code:'49',name:'Quảng Nam'},{code:'51',name:'Quảng Ngãi'},{code:'70',name:'Bình Thuận'},
        {code:'68',name:'Lâm Đồng'},{code:'73',name:'Bình Phước'},{code:'71',name:'Ninh Thuận'},
        {code:'36',name:'Ninh Bình'},{code:'35',name:'Nam Định'},{code:'34',name:'Thái Bình'},
        {code:'33',name:'Hà Nam'},{code:'26',name:'Vĩnh Phúc'},{code:'27',name:'Bắc Ninh'},
        {code:'30',name:'Hải Dương'},{code:'14',name:'Cao Bằng'},{code:'06',name:'Bắc Kạn'},
        {code:'08',name:'Tuyên Quang'},{code:'10',name:'Lào Cai'},{code:'11',name:'Điện Biên'},
        {code:'12',name:'Lai Châu'},{code:'02',name:'Hà Giang'},{code:'04',name:'Cao Bằng'},
        {code:'20',name:'Thái Nguyên'},{code:'22',name:'Bắc Giang'},{code:'24',name:'Phú Thọ'},
        {code:'25',name:'Yên Bái'},{code:'17',name:'Lạng Sơn'},{code:'58',name:'Quảng Trị'},
    ];
    const select = document.getElementById('tinh');
    provinces.sort((a,b)=>a.name.localeCompare(b.name,'vi'));
    provinces.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.code;
        opt.textContent = t.name;
        select.appendChild(opt);
    });
}

async function loadHuyen() {
    const tinhCode = document.getElementById('tinh').value;
    const huyenSelect = document.getElementById('huyen');
    const xaSelect = document.getElementById('xa');

    huyenSelect.innerHTML = '<option value="">-- Chọn Quận / Huyện --</option>';
    xaSelect.innerHTML = '<option value="">-- Chọn Phường / Xã --</option>';
    huyenSelect.disabled = true;
    xaSelect.disabled = true;
    document.getElementById('diaChiChiTietWrapper').style.display = 'none';
    hideMap();

    if (!tinhCode) return;

    try {
        const res = await fetch(`https://provinces.open-api.vn/api/p/${tinhCode}?depth=2`);
        const data = await res.json();
        const districts = data.districts || [];
        districts.sort((a,b)=>a.name.localeCompare(b.name,'vi'));
        districts.forEach(h => {
            const opt = document.createElement('option');
            opt.value = h.code;
            opt.textContent = h.name;
            huyenSelect.appendChild(opt);
        });
        huyenSelect.disabled = false;
        huyenSelect.style.opacity = '1';
    } catch(e) {
        huyenSelect.disabled = false;
        huyenSelect.style.opacity = '1';
    }
    updateAddress();
}

async function loadXa() {
    const huyenCode = document.getElementById('huyen').value;
    const xaSelect = document.getElementById('xa');
    xaSelect.innerHTML = '<option value="">-- Chọn Phường / Xã --</option>';
    xaSelect.disabled = true;
    document.getElementById('diaChiChiTietWrapper').style.display = 'none';

    if (!huyenCode) return;

    try {
        const res = await fetch(`https://provinces.open-api.vn/api/d/${huyenCode}?depth=2`);
        const data = await res.json();
        const wards = data.wards || [];
        wards.sort((a,b)=>a.name.localeCompare(b.name,'vi'));
        wards.forEach(x => {
            const opt = document.createElement('option');
            opt.value = x.code;
            opt.textContent = x.name;
            xaSelect.appendChild(opt);
        });
        xaSelect.disabled = false;
        xaSelect.style.opacity = '1';
    } catch(e) {
        xaSelect.disabled = false;
        xaSelect.style.opacity = '1';
    }
    updateAddress();
}

function updateAddress() {
    const tinh = document.getElementById('tinh');
    const huyen = document.getElementById('huyen');
    const xa = document.getElementById('xa');
    const chiTiet = document.getElementById('diaChiChiTiet').value.trim();

    const tinhText = tinh.options[tinh.selectedIndex]?.text || '';
    const huyenText = huyen.options[huyen.selectedIndex]?.text || '';
    const xaText = xa.options[xa.selectedIndex]?.text || '';

    // Hiện ô chi tiết sau khi chọn phường/xã
    if (xa.value) {
        document.getElementById('diaChiChiTietWrapper').style.display = 'block';
    }

    // Ghép địa chỉ
    const parts = [chiTiet, xaText, huyenText, tinhText].filter(p => p && p !== '-- Chọn Quận / Huyện --' && p !== '-- Chọn Phường / Xã --' && p !== '-- Chọn Tỉnh / Thành phố --');
    const fullAddress = parts.join(', ');

    document.getElementById('DiaChiGiaoHangFull').value = fullAddress;

    const preview = document.getElementById('addressPreview');
    if (fullAddress) {
        document.getElementById('addressPreviewText').textContent = fullAddress;
        preview.style.display = 'block';
        // Hiển thị bản đồ khi đã có địa chỉ chi tiết + phường/xã
        if (chiTiet && xa.value) {
            showMapForAddress(fullAddress);
        }
    } else {
        preview.style.display = 'none';
    }
}

// ==============================
// 2. BẢN ĐỒ (Leaflet + OpenStreetMap)
// ==============================
function initMap(lat, lng, label) {
    const mapWrapper = document.getElementById('mapWrapper');
    mapWrapper.style.display = 'block';

    if (!map) {
        map = L.map('map').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);
    } else {
        map.setView([lat, lng], 15);
    }

    if (marker) {
        marker.setLatLng([lat, lng]);
    } else {
        marker = L.marker([lat, lng], { draggable: true }).addTo(map);
        marker.on('dragend', function(e) {
            const pos = e.target.getLatLng();
            reverseGeocode(pos.lat, pos.lng);
        });
    }

    if (label) {
        marker.bindPopup(label).openPopup();
    }

    setTimeout(() => map.invalidateSize(), 100);
}

async function showMapForAddress(address) {
    try {
        const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&countrycodes=vn&limit=1`);
        const data = await res.json();
        if (data && data.length > 0) {
            initMap(parseFloat(data[0].lat), parseFloat(data[0].lon), address);
        } else {
            // Fallback: tọa độ trung tâm Việt Nam
            initMap(16.047079, 108.206230, address);
        }
    } catch(e) {
        initMap(16.047079, 108.206230, address);
    }
}

async function reverseGeocode(lat, lng) {
    try {
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
        const data = await res.json();
        if (data && data.display_name) {
            document.getElementById('addressPreviewText').textContent = data.display_name;
            document.getElementById('DiaChiGiaoHangFull').value = data.display_name;
        }
    } catch(e) {}
}

function hideMap() {
    document.getElementById('mapWrapper').style.display = 'none';
}

// ==============================
// 3. LẤY VỊ TRÍ HIỆN TẠI
// ==============================
function getLocation() {
    const btn = document.getElementById('btnGetLocation');
    if (!navigator.geolocation) {
        alert('Trình duyệt của bạn không hỗ trợ định vị!');
        return;
    }
    btn.textContent = '⏳ Đang lấy vị trí...';
    btn.disabled = true;

    navigator.geolocation.getCurrentPosition(
        async function(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            btn.innerHTML = '<span>📍</span> Sử dụng vị trí hiện tại của tôi';
            btn.disabled = false;

            // Reverse geocode
            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=vi`);
                const data = await res.json();
                if (data && data.display_name) {
                    document.getElementById('DiaChiGiaoHangFull').value = data.display_name;
                    document.getElementById('addressPreviewText').textContent = data.display_name;
                    document.getElementById('addressPreview').style.display = 'block';

                    // Điền vào ô chi tiết nếu có
                    const addr = data.address;
                    if (addr) {
                        const chiTiet = [addr.house_number, addr.road].filter(Boolean).join(' ');
                        if (chiTiet) {
                            document.getElementById('diaChiChiTiet').value = chiTiet;
                            document.getElementById('diaChiChiTietWrapper').style.display = 'block';
                        }
                    }
                }
            } catch(e) {
                document.getElementById('DiaChiGiaoHangFull').value = `${lat}, ${lng}`;
            }

            initMap(lat, lng, 'Vị trí của bạn');
        },
        function(err) {
            btn.innerHTML = '<span>📍</span> Sử dụng vị trí hiện tại của tôi';
            btn.disabled = false;
            let msg = 'Không thể lấy vị trí.';
            if (err.code === 1) msg = '🚫 Bạn đã từ chối quyền vị trí. Hãy bật trong cài đặt trình duyệt rồi thử lại.';
            if (err.code === 2) msg = '⚠️ Không xác định được vị trí. Vui lòng thử lại.';
            if (err.code === 3) msg = '⏰ Quá thời gian lấy vị trí. Vui lòng thử lại.';
            showToast(msg, 'error');
        },
        { timeout: 10000, enableHighAccuracy: true }
    );
}

// ==============================
// 4. VALIDATE SỐ ĐIỆN THOẠI
// ==============================
let phoneTouched = false;

function onPhoneInput(input) {
    // Chỉ giữ lại chữ số
    input.value = input.value.replace(/[^0-9]/g, '');
    if (phoneTouched) validatePhone(input);
}

function validatePhone(input) {
    phoneTouched = true;
    const val = input.value;
    const errEl = document.getElementById('phoneError');
    // Chỉ báo lỗi khi đã có ký tự nhập vào
    if (val.length === 0) {
        input.style.borderColor = 'var(--border)';
        errEl.style.display = 'none';
    } else if (val.length < 9 || val.length > 11) {
        input.style.borderColor = '#ef4444';
        errEl.style.display = 'block';
    } else {
        input.style.borderColor = 'var(--primary)';
        errEl.style.display = 'none';
    }
}

// ==============================
// 5. TOAST NOTIFICATION
// ==============================
function showToast(message, type = 'info') {
    const colors = {
        error: { bg: 'rgba(239,68,68,0.15)', border: 'rgba(239,68,68,0.4)', text: '#f87171' },
        success: { bg: 'rgba(34,197,94,0.15)', border: 'rgba(34,197,94,0.4)', text: '#4ade80' },
        info: { bg: 'rgba(99,102,241,0.15)', border: 'rgba(99,102,241,0.4)', text: '#818cf8' },
    };
    const c = colors[type] || colors.info;
    const toast = document.createElement('div');
    toast.style.cssText = `background:${c.bg}; border:1px solid ${c.border}; color:${c.text}; padding:0.8rem 1.2rem; border-radius:10px; font-size:0.88rem; max-width:320px; backdrop-filter:blur(10px); box-shadow:0 4px 20px rgba(0,0,0,0.3); animation: slideIn 0.3s ease;`;
    toast.textContent = message;
    document.getElementById('toastContainer').appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.4s'; setTimeout(() => toast.remove(), 400); }, 4000);
}

// ==============================
// 6. SUBMIT FORM VALIDATION
// ==============================
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    // Validate phone
    phoneTouched = true;
    const phoneInput = document.getElementById('DienThoai');
    const phone = phoneInput.value;
    if (!/^[0-9]{9,11}$/.test(phone)) {
        e.preventDefault();
        validatePhone(phoneInput);
        phoneInput.focus();
        showToast('⚠️ Vui lòng nhập số điện thoại hợp lệ (9-11 chữ số).', 'error');
        return;
    }

    // Validate địa chỉ
    const addr = document.getElementById('DiaChiGiaoHangFull').value.trim();
    if (!addr) {
        e.preventDefault();
        showToast('📍 Vui lòng chọn địa chỉ giao hàng!', 'error');
        return;
    }
});

// ==============================
// 7. KHỞI ĐỘNG
// ==============================
loadTinh();

// CSS animation
const style = document.createElement('style');
style.textContent = `@keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }`;
document.head.appendChild(style);
</script>
@endsection
