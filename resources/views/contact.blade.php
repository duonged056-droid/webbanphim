@extends('layouts.app')

@section('title', 'Liên Hệ - KEYLABS')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-10">
        <span class="text-xs font-mono uppercase text-brand-400 font-semibold tracking-wider">Hỗ trợ & Tư vấn</span>
        <h1 class="text-3xl font-extrabold text-white mt-2">Liên Hệ Với KEYLABS</h1>
        <p class="text-gray-400 text-sm mt-2">Đội ngũ kỹ thuật viên luôn sẵn sàng tư vấn custom phím và giải đáp mọi thắc mắc.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="p-6 rounded-2xl bg-dark-800 border border-white/10 text-center">
            <div class="w-12 h-12 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-phone"></i>
            </div>
            <h3 class="font-bold text-white text-base">Hotline</h3>
            <p class="text-sm text-gray-400 mt-1">0987.654.321</p>
            <p class="text-xs text-gray-500 mt-0.5">8:30 - 21:30 hàng ngày</p>
        </div>

        <div class="p-6 rounded-2xl bg-dark-800 border border-white/10 text-center">
            <div class="w-12 h-12 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h3 class="font-bold text-white text-base">Email Hỗ Trợ</h3>
            <p class="text-sm text-gray-400 mt-1">support@keylabs.vn</p>
            <p class="text-xs text-gray-500 mt-0.5">Phản hồi trong 2 giờ</p>
        </div>

        <div class="p-6 rounded-2xl bg-dark-800 border border-white/10 text-center">
            <div class="w-12 h-12 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mx-auto mb-4 text-xl">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h3 class="font-bold text-white text-base">Showroom Trải Nghiệm</h3>
            <p class="text-sm text-gray-400 mt-1">Hà Nội & TP. Hồ Chí Minh</p>
            <p class="text-xs text-gray-500 mt-0.5">Test phím & switch trực tiếp</p>
        </div>
    </div>

    <!-- Contact Form Box -->
    <div class="p-8 rounded-3xl bg-dark-800/90 border border-white/10">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fa-regular fa-paper-plane text-brand-400"></i> Gửi Tin Nhắn Cho Chúng Tôi
        </h2>
        <form onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã liên hệ! KEYLABS sẽ phản hồi sớm nhất.');" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-medium text-gray-300 mb-2">Họ và tên</label>
                    <input type="text" required placeholder="Nguyễn Văn A" class="form-control">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-300 mb-2">Số điện thoại</label>
                    <input type="tel" required placeholder="09xxxxxxxx" class="form-control">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-300 mb-2">Email</label>
                <input type="email" required placeholder="name@example.com" class="form-control">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-300 mb-2">Nội dung cần tư vấn / góp ý</label>
                <textarea rows="4" required placeholder="Bạn muốn tư vấn mẫu phím, lube switch, hoặc tra cứu đơn..." class="form-control" style="resize: none;"></textarea>
            </div>
            <div class="text-right pt-2">
                <button type="submit" class="btn px-8 py-3">
                    <i class="fa-solid fa-paper-plane mr-1.5"></i> Gửi tin nhắn
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

