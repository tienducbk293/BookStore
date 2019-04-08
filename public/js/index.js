// Initialize Firebase
var config = {
    apiKey: "AIzaSyATEWess4TzascKpn85ApXY_Z68j-FCFlY",
    authDomain: "bookstore-f7ae3.firebaseapp.com",
    databaseURL: "https://bookstore-f7ae3.firebaseio.com",
    projectId: "bookstore-f7ae3",
    storageBucket: "bookstore-f7ae3.appspot.com",
    messagingSenderId: "421717153339"
};
firebase.initializeApp(config);

firebase.auth().signInWithCustomToken(customToken) // token này được truyền từ server xuống client (từ file blade của Laravel vào file js)
    .then(function () {
        alert('Đăng nhập thành công');
    })
    .catch(function(error) {
        if (error.code === 'auth/invalid-custom-token') {
            alert('Hết hạn đăng nhập');
        } else {
            alert('Lỗi xác thực');
        }
    });