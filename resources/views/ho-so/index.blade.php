@extends('layouts.app')

@section('title', 'Hồ Sơ Cá Nhân - KEYLABS')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center gap-4">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-indigo-500/30 text-white text-2xl font-bold">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-white">{{ $user->name }}</h1>
            <p class="text-gray-400 text-sm">{{ $user->email }}
                @if($user->so_dien_thoai)
                    · <i class="fa-solid fa-phone text-xs"></i> {{ $user->so_dien_thoai }}
                @endif
            </p>
        </div>
    </div>

    {{-- Tab Nav --}}
    <div class="flex gap-2 mb-6 border-b border-white/10 pb-0" id="tabNav">
        <button onclick="showTab('thongtin')" id="tab-thongtin"
            class="tab-btn px-5 py-2.5 text-sm font-semibold rounded-t-xl border-b-2 border-indigo-500 text-indigo-400 bg-indigo-500/10 transition-all">
            <i class="fa-solid fa-user mr-1"></i> Thông tin cá nhân
        </button>
        <button onclick="showTab('matkhau')" id="tab-matkhau"
            class="tab-btn px-5 py-2.5 text-sm font-semibold rounded-t-xl border-b-2 border-transparent text-gray-400 hover:text-white transition-all">
            <i class="fa-solid fa-lock mr-1"></i> Đổi mật khẩu
        </button>
        <button onclick="showTab('diachi')" id="tab-diachi"
            class="tab-btn px-5 py-2.5 text-sm font-semibold rounded-t-xl border-b-2 border-transparent text-gray-400 hover:text-white transition-all">
            <i class="fa-solid fa-map-marker-alt mr-1"></i> Địa chỉ giao hàng
            <span class="ml-1 bg-indigo-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ $diaChis->count() }}</span>
        </button>
    </div>

    {{-- ── TAB 1: Thông tin cá nhân ── --}}
    <div id="pane-thongtin" class="tab-pane">
        <div class="bg-gray-900/60 backdrop-blur border border-white/10 rounded-2xl p-6 shadow-xl">
            <form action="{{ route('ho-so.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('POST')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Họ tên --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Họ và tên *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="form-control @error('name') border-rose-500 @enderror">
                        @error('name')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Số điện thoại --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Số điện thoại</label>
                        <input type="tel" name="so_dien_thoai" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}"
                            placeholder="0912 345 678"
                            class="form-control @error('so_dien_thoai') border-rose-500 @enderror">
                        @error('so_dien_thoai')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Ngày sinh --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Ngày sinh</label>
                        <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh', $user->ngay_sinh?->format('Y-m-d')) }}"
                            class="form-control">
                    </div>

                    {{-- Giới tính --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Giới tính</label>
                        <select name="gioi_tinh" class="form-control">
                            <option value="">-- Chọn --</option>
                            @foreach(['Nam','Nữ','Khác'] as $gt)
                                <option value="{{ $gt }}" {{ old('gioi_tinh', $user->gioi_tinh) === $gt ? 'selected' : '' }}>{{ $gt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Địa chỉ thường trú --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Địa chỉ thường trú</label>
                    <input type="text" name="dia_chi" value="{{ old('dia_chi', $user->dia_chi) }}"
                        placeholder="Số nhà, tên đường..."
                        class="form-control">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Phường / Xã</label>
                        <input type="text" name="phuong_xa" value="{{ old('phuong_xa', $user->phuong_xa) }}" class="form-control" placeholder="Phường Bến Nghé">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Quận / Huyện</label>
                        <input type="text" name="quan_huyen" value="{{ old('quan_huyen', $user->quan_huyen) }}" class="form-control" placeholder="Quận 1">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Tỉnh / Thành phố</label>
                        <input type="text" name="tinh_thanh" value="{{ old('tinh_thanh', $user->tinh_thanh) }}" class="form-control" placeholder="TP. Hồ Chí Minh">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── TAB 2: Đổi mật khẩu ── --}}
    <div id="pane-matkhau" class="tab-pane hidden">
        <div class="bg-gray-900/60 backdrop-blur border border-white/10 rounded-2xl p-6 shadow-xl max-w-md">
            <form action="{{ route('ho-so.doi-mat-khau') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Mật khẩu hiện tại *</label>
                    <input type="password" name="mat_khau_cu" required class="form-control @error('mat_khau_cu') border-rose-500 @enderror">
                    @error('mat_khau_cu')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Mật khẩu mới *</label>
                    <input type="password" name="mat_khau_moi" required minlength="6"
                        class="form-control @error('mat_khau_moi') border-rose-500 @enderror">
                    @error('mat_khau_moi')<p class="text-rose-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Xác nhận mật khẩu mới *</label>
                    <input type="password" name="mat_khau_moi_confirmation" required class="form-control">
                </div>

                <button type="submit" class="btn">
                    <i class="fa-solid fa-key mr-2"></i> Đổi mật khẩu
                </button>
            </form>
        </div>
    </div>

    {{-- ── TAB 3: Địa chỉ giao hàng ── --}}
    <div id="pane-diachi" class="tab-pane hidden">

        {{-- Danh sách địa chỉ --}}
        @forelse($diaChis as $dc)
        <div class="bg-gray-900/60 backdrop-blur border {{ $dc->la_mac_dinh ? 'border-indigo-500/60' : 'border-white/10' }} rounded-2xl p-5 mb-4 flex items-start justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-semibold text-white">{{ $dc->ho_ten }}</span>
                    <span class="text-gray-400">·</span>
                    <span class="text-gray-400 text-sm">{{ $dc->so_dien_thoai }}</span>
                    @if($dc->la_mac_dinh)
                        <span class="text-xs bg-indigo-500/20 text-indigo-400 border border-indigo-500/40 rounded-full px-2 py-0.5">Mặc định</span>
                    @endif
                </div>
                <p class="text-gray-400 text-sm">{{ $dc->dia_chi_day_du }}</p>
            </div>
            <div class="flex gap-2 shrink-0">
                @if(!$dc->la_mac_dinh)
                <form action="{{ route('dia-chi.mac-dinh', $dc->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border border-white/10 text-gray-300 hover:border-indigo-500 hover:text-indigo-400 transition-all">
                        Đặt mặc định
                    </button>
                </form>
                @endif
                <form action="{{ route('dia-chi.xoa', $dc->id) }}" method="POST" onsubmit="return confirm('Xoá địa chỉ này?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border border-rose-500/30 text-rose-400 hover:bg-rose-500/10 transition-all">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-gray-500">
            <i class="fa-solid fa-map-marked-alt text-4xl mb-3 block"></i>
            Chưa có địa chỉ giao hàng nào
        </div>
        @endforelse

        {{-- Form thêm địa chỉ mới --}}
        <div class="bg-gray-900/60 backdrop-blur border border-dashed border-white/20 rounded-2xl p-6 mt-4">
            <h3 class="text-base font-bold text-white mb-4"><i class="fa-solid fa-plus mr-2 text-indigo-400"></i>Thêm địa chỉ mới</h3>
            <form action="{{ route('dia-chi.them') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Họ tên người nhận *</label>
                        <input type="text" name="ho_ten" required value="{{ old('ho_ten', $user->name) }}" class="form-control">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Số điện thoại *</label>
                        <input type="tel" name="so_dien_thoai" required value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" class="form-control">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Địa chỉ (số nhà, đường) *</label>
                    <input type="text" name="dia_chi" required class="form-control" placeholder="123 Nguyễn Huệ">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Phường / Xã</label>
                        <input type="text" name="phuong_xa" class="form-control">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Quận / Huyện</label>
                        <input type="text" name="quan_huyen" class="form-control">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Tỉnh / TP *</label>
                        <input type="text" name="tinh_thanh" required class="form-control">
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-300 cursor-pointer">
                    <input type="checkbox" name="la_mac_dinh" value="1" class="w-4 h-4 accent-indigo-500">
                    Đặt làm địa chỉ mặc định
                </label>

                <button type="submit" class="btn">
                    <i class="fa-solid fa-plus mr-2"></i> Thêm địa chỉ
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showTab(id) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('border-indigo-500','text-indigo-400','bg-indigo-500/10');
        b.classList.add('border-transparent','text-gray-400');
    });
    document.getElementById('pane-' + id).classList.remove('hidden');
    const btn = document.getElementById('tab-' + id);
    btn.classList.add('border-indigo-500','text-indigo-400','bg-indigo-500/10');
    btn.classList.remove('border-transparent','text-gray-400');
}

// Giữ tab khi có lỗi validation
@if(isset($errors) && $errors->any())
    @if($errors->has('mat_khau_cu') || $errors->has('mat_khau_moi'))
        showTab('matkhau');
    @elseif($errors->has('ho_ten') || $errors->has('dia_chi') || $errors->has('tinh_thanh'))
        showTab('diachi');
    @endif
@endif
</script>
@endsection

