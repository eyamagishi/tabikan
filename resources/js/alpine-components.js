// 予約フォーム用Alpineコンポーネント
window.reservationForm = function ({ checkIn = '', checkOut = '', guestCount = 1 } = {}) {
    return {
        checkIn,
        checkOut,
        guestCount,
        dateError: false,
        guestCountError: false,

        validateDates() {
            // checkIn, checkOut両方がある場合のみチェック
            if (this.checkIn && this.checkOut) {
                this.dateError = new Date(this.checkOut) <= new Date(this.checkIn);
            } else {
                this.dateError = false;
            }
        },

        validateGuestCount() {
            this.guestCountError = !(this.guestCount >= 1 && this.guestCount <= 10);
        },

        init() {
            this.validateDates();
            this.validateGuestCount();
        }
    };
};
