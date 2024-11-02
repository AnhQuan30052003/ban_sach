<style>
	.footer {
		border-top: 4px solid var(--primary-color);
		background-color: var(--white-color);
	}

	.footer__distance {
		height: 120px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.12);
	}

	.footer__top-list {
		display: flex;
		justify-content: space-between;
		height: 120px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.12);
	}

	.footer__top-item {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.footer__top-item-img {
		width: 50px;
		height: 50px;
	}

	.footer__top-item-desc {
		flex: 1;
		max-width: 275px;
	}

	.footer__top-item-desc p {
		font-size: 14px;
		margin: 0;
		color: rgba(0, 0, 0, 0.54);
	}

	.footer__heading {
		font-size: 14px;
		text-transform: uppercase;
		color: var(--text-color);
	}

	.footer__pay {
		display: flex;
		flex-wrap: wrap;
	}

	.footer__pay a {
		display: block;
		border-radius: 2px;
		box-shadow: 0 2px 2px #e7e0e0;
		padding: 4px;
		margin-bottom: 4px;
		margin-right: 10px;
	}

	.footer__pay img {
		width: 100%;
		height: 100%;
		object-fit: contain;
	}

	.footer-item__link {
		font-size: 12px;
		color: rgba(0, 0, 0, 0.54);
		padding: 4px 0;
		display: block;
		font-weight: 500;
		display: flex;
		align-items: center;
	}

	.footer-item__link:hover {
		color: var(--primary-color);
	}

	.footer-item-icon {
		font-size: 18px;
		margin-right: 5px;
	}

	.footer__download {
		display: flex;
		align-items: center;
	}

	.footer__download-qr {
		width: 80px;
		object-fit: contain;
		border: 1px solid rgba(0, 0, 0, 0.1);
	}

	.footer__download-app {
		flex: 1;
		margin-left: 16px;
	}

	.footer__download-app-img {
		height: 16px;
	}

	.footer__download-app-link {
		display: block;
		line-height: 0;
		padding: 6px;
	}

	.footer__bottom {
		background-color: #d8d7d7;
		padding: 9px 0;
		margin-top: 36px;
	}

	.footer__text {
		margin: 0;
		text-align: center;
		font-size: 12px;
		color: rgba(0, 0, 0, 0.54);
	}
</style>

<footer class="footer">
	<div class="grid wide">
		<div class="footer__top-list">
			<div class="footer__top-item">
				<img class="footer__top-item-img" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/6c502a2641457578b0d5f5153b53dd5d.png" alt="">
				<div class="footer__top-item-desc">
					<p>7 ngày miễn phí trả hàng</p>
					<p>Trả hàng miễn phí trong 7 ngày</p>
				</div>
			</div>
			<div class="footer__top-item">
				<img class="footer__top-item-img" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/511aca04cc3ba9234ab0e4fcf20768a2.png" alt="">
				<div class="footer__top-item-desc">
					<p>Hàng chính hãng 100%</p>
					<p>Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</p>
				</div>
			</div>
			<div class="footer__top-item last-mb-none">
				<img class="footer__top-item-img" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/16ead7e0a68c3cff9f32910e4be08122.png" alt="">
				<div class="footer__top-item-desc">
					<p>Miễn phí vận chuyển</p>
					<p>Giao hàng miễn phí toàn quốc</p>
				</div>
			</div>
		</div>

		<!-- <div class="footer__distance hide-on-mobile"></div> -->

		<div class="row mt-20 footer-content">
			<div class="col l-2-4 m-4 c-6">
				<h3 class="footer__heading">Chăm sóc khách hàng</h3>
				<ul class="footer-list">
					<li class="footer-item">
						<a href="" class="footer-item__link">Trung Tâm Trợ Giúp </a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">TienQuan-ShopMall </a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">Chính Sách Bảo Hành </a>
					</li>
				</ul>
			</div>
			<div class="col l-2-4 m-4 c-6">
				<h3 class="footer__heading">Về chúng tôi</h3>
				<ul class="footer-list">
					<li class="footer-item">
						<a href="" class="footer-item__link">Giới Thiệu Về Sach Việt Nam </a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">Tuyển Dụng </a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">Kênh Người Bán</a>
					</li>
				</ul>
			</div>
			<div class="col l-2-4 m-4 c-6">
				<h3 class="footer__heading">Thanh toán</h3>
				<div class="footer__pay">
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/d4bbea4570b93bfd5fc652ca82a262a8" alt="">
					</a>
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/a0a9062ebe19b45c1ae0506f16af5c16">
					</a>
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/38fd98e55806c3b2e4535c4e4a6c4c08" alt="">
					</a>
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/bc2a874caeee705449c164be385b796c" alt="">
					</a>
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/2c46b83d84111ddc32cfd3b5995d9281" alt="">
					</a>
					<a href="">
						<img src="https://down-vn.img.susercontent.com/file/5e3f0bee86058637ff23cfdf2e14ca09" alt="">
					</a>
				</div>

			</div>
			<div class="col l-2-4 m-4 c-6">
				<h3 class="footer__heading">Theo dõi chúng tôi trên</h3>
				<ul class="footer-list">
					<li class="footer-item">
						<a href="" class="footer-item__link">
							<i class="footer-item-icon fa-brands fa-facebook"></i>
							Facebook
						</a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">
							<i class="footer-item-icon fa-brands fa-square-instagram"></i>
							Instagram
						</a>
					</li>
					<li class="footer-item">
						<a href="" class="footer-item__link">
							<i class="footer-item-icon fa-brands fa-linkedin"></i>
							LinkedIn
						</a>
					</li>
				</ul>
			</div>
			<div class="col l-2-4 m-8 c-6">
				<h3 class="footer__heading">Tải ứng dụng sach ngay thôi</h3>
				<div class="footer__download">
					<img src="../../assets/images/qrcode.png" alt="Download QR" class="footer__download-qr">
					<div class="footer__download-app">
						<a class="footer__download-app-link" href="">
							<img src="../../assets/images/ggplay.png" alt="Google Play" class="footer__download-app-img">
						</a>
						<a class="footer__download-app-link" href="">
							<img src="../../assets/images/appstore.png" alt="App Store" class="footer__download-app-img">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer__bottom">
		<div class="grid wide">
			<p class="footer__text">© 2024 - Bản quyền thuộc về Công Ty Tiến Quân</p>
		</div>
	</div>
</footer>