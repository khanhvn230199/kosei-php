<?php
global $ENV_API;
if ($ENV_API=="dev"){
	//CẤU HÌNH TÀI KHOẢN (Configure account)
	define('EMAIL_BUSINESS','dev.baokim@bk.vn');//Email Bảo kim
	define('MERCHANT_ID','647');                // Mã website tích hợp
	define('SECURE_PASS','ae543c080ad91c23');   // Mật khẩu
	
	// Cấu hình tài khoản tích hợp
	define('API_USER','merchant');  //API USER
	//define('API_PWD','2q1vYc8pJ57bAW9VjCnXH1htk3GOK');       //API PASSWORD
	define('API_PWD','1234');       //API PASSWORD
	define('PRIVATE_KEY_BAOKIM','-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDZZBAIQz1UZtVm
p0Jwv0SnoIkGYdHUs7vzdfXYBs1wvznuLp/SfC/MHzHVQw7urN8qv+ZDxzTMgu2Q
3FhMOQ+LIoqYNnklm+5EFsE8hz01sZzg+uRBbyNEdcTa39I4X88OFr13KoJC6sBE
397+5HG1HPjip8a83v8G4/IPcna5/3ydVbJ9ZeMSUXP6ZyKAKay4M22/Wli7PLrm
1XNR9JgIuQLma74yCGkaXtCJQswjyYAmwDPpz4ZknSGuBYUmwaHMgrDOQsOXFW7/
7M2KbjenwggAW98f0f97AR2DEq9Eb5r8vzyHURnHGD3/noZxl993lM2foPI3SKBO
1KpSeXRzAgMBAAECggEANMINBgRTgQVH6xbSkAxLPCdAufTJeMZ56bcKB/h2qVMv
Wvejv/B1pSM489nHaPM5YeWam35f+PYZc5uWLkF23TxvyEsIEbGLHKktEmR73WkS
eqNI+/xd4cJ3GOtS2G2gEXpBVwdQ/657JPvz4YZNdjfmyxMOr02rNN/jIg6Uc8Tz
vbpGdtP49nhqcOUpbKEyUxdDo6TgLVgmLAKkGJVW40kwvU9hTTo6GXledLNtL2kD
l6gpVWAiT6xlTsD5m74YzsxCSjkh60NdYeUDYwMbv0WWH3kJq6qD063ac3i/i8H+
B5nGf4KbKg1bBjPLNymUj7RRnKjHr301i2u8LUQYuQKBgQD15YCoa5uHd6DHUXEK
kejU34Axznr3Gs6LqcisE7t0oQ9hB4s16U9f4DBHDOvnkLb0zkadwdEmwo/D/Tdf
5c/JEk8q/aO9Wk8uV4Bswnx1OV9uKMzMOZbv/So1DQg1aW1MgvRnj3SiKpDUkNwr
en4NT9tbH21SmVIO9Da5KpiFRwKBgQDiUrg1hp8EDaeZFTG9DvcwyTTrpD/YT9Wr
s/NtEnPMjy0NXWcEXwGzx90P+qjJ+J29Hk89QHON6S7o0X2lUIer3uXokc86ce76
5UIbR6u7R1T6TUNfwqwwNfIbgtFN4+7ybodPNZ5DWslKLqMr5wpwIOr7/U5ih7BH
JK0cSriddQKBgGXzNZiepOlRrBN3rMqZHFPGJrx/w3PYZXJ6fnz54WrFrD6qhglg
Jky2As4yiUyFL5XoQFcAGNtdJ4Y24lKcUb4oHTLR3qWPX+zy0ohFSpy/oNVnjSHP
bskpyeoc8R5UC8EBOpwFWnIx+8JmHSLZspGKXoQ1T3pDn0Yb8uRqyLnZAoGBAKdk
NwqfvwzobIU0v8ztPLbAmnuOyAndQlP0jJ6nfy5U1yWDZ6Y7/q5RrJcc9aosT76I
pGLRQKY9SYy5JQ0YOsBL5A/XiEXZ7r9ywSocIFAruhZG/wXcni4qOB9Q6i2J4Dk+
tqVHKv72LtrHE7hs8bNtJV+rQkZtxVtZLRA308PhAoGBALVEaYMRm97V+Tnsej6q
fuT/6oKHPqZpur2rNfEKVn5Aq2kmFrvyUhvXi0IAWQ/XS3XJ7faQnprrWT6pYiSy
2YQuaghlNG1SATVd5eUadq2pA8DuSzqWFa0Ac1IAyliBO2uLPL7LzuEKmmuQk0vI
TU2Q8idAb77K7mvVguA3LDhN
-----END PRIVATE KEY-----');
	
	define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
	define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
	define('BAOKIM_API_PAYMENT','/payment/order/version11');
	
	define('BAOKIM_URL','https://sandbox.baokim.vn');
	//define('BAOKIM_URL','http://baokim.dev');
	//define('BAOKIM_URL','http://timnguoicho.');
	
	//Phương thức thanh toán bằng thẻ nội địa
	define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
	//Phương thức thanh toán bằng thẻ tín dụng quốc tế
	define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
	//Dịch vụ chuyển khoản online của các ngân hàng
	define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
	//Dịch vụ chuyển khoản ATM
	define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
	//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
	define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);
}else{
	//CẤU HÌNH TÀI KHOẢN (Configure account)
	define('EMAIL_BUSINESS','trantoan23021995@gmail.com');//Email Bảo kim
	define('MERCHANT_ID','33739');                // Mã website tích hợp
	define('SECURE_PASS','b683f73f15889d54');   // Mật khẩu
	
	// Cấu hình tài khoản tích hợp
	define('API_USER','0972441714');  //API USER
	//define('API_PWD','2q1vYc8pJ57bAW9VjCnXH1htk3GOK');       //API PASSWORD
	define('API_PWD','6nP8zvF9uR19o7D4VpiBa0wc9CjGh');       //API PASSWORD
	define('PRIVATE_KEY_BAOKIM','-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEA3qHbEVtb5OFy1HtvYwjsCDjap6ZyI0nyzOwtY70YWOxSnIdq
R5mktkL5pWNasneSj2u1wZ6a5hRnDSSMxQmPJ2G4XQ6AIAvNYOTsBEn9UguHEr45
8gZlj+fg9VlLm3RbMhN7g/sKAmwgXc4FXaGp7FAKddki61ksRG8Vj4nnQpskqgkS
bwWUYolQXq44Fp/6n0Nt+Qg/8dR8Ky8A/JShNRHAlBj6I9tUsO2xxrMe6osXIs+f
ACH+SYOqcYEmN/icPWsFmO4XABvtWSAsvmICXul1eg7idqErnB1clQJN3XoVUYFT
oStAv8QJiJ10KJA0nEmJASIsGxFxFSJZIKxdbwIDAQABAoIBABWhBeZuyMO4v24z
O8QUVtIJq/yDqC0Tfxo3i8VX1qi09OWuJj4kiCMI6LYPq/0QrtVuMm9IGGZn7wcQ
2Pg/kH/T95Ra10nFu8NBGkjkY074PbwtbPW9d1p+vZU4gqbsq/t2dxaAah2IIbDb
Vhwdm6OQtyNx3/mbZTiUzjRuwl/vAkJ8IurlExHPrrbhSix5o7CycBzfUZcVTqCy
5uK9eX6UsSFrMDFjbN4QP8DVx6OU8NoVOJLKMC18FeVrKOd8oWywCPqYI0bV6L7f
q6uBLlCnjEWLvB/C2B8T+Q90UZzevMaXiRmlfteAsasXEblXOPp3y68UKMajqKHL
AX02MAkCgYEA8EIuD3G+w4pvqqxeWesrLDG6e3saM+RGilHfKcJHQil2OF+pRQvA
9wt6oyubyvbO82P7XSX9lZ3psW69cOh4wjYUNVAisazShZch0M+hRD342cLCZzuI
DkZ8yatSsQ99XYE7/Tn8zbeFOIsuDAiTBxHTc+EAtyR2t55srknSjmsCgYEA7TgI
eFAk7CZF70DYxYg42cC3/1iFDBO1142UiBLsvl/qMG2ElzJp90yL31GSGh6SlolP
bRMV2umXLt5LUIZmr3n97bsjsj416+2PxGJa3VYPKzZQO+Jm66QwRO8EsEHkC4MP
bo9x+l6//uAN3wquZiAAWXFbFG8CAZPVlKLV5g0CgYB1V103nc4Vop83NEhAkmLb
is4RUOZTQcJR+/qKYqB659UdY1tApaTxA2I6HypPzor0xHgX3l4jnKRuTC+p3WBd
OhxUjXbkYAvRwyZ43W9d7QaFFGHuGV0x26tGs64HXBFWga/S1Wdq8Z7XJuKubeGh
Kkuj5Nh8mgqBU5aw6M01UQKBgDgFVJK9MosGWtuur8KuceaSyaEm0XzRps7544rj
FT+8PP0kz/w47qd1T07035EFiU69rKEwsaeaJJbv7k9c/iEQqTQcTsjIQkmuN5aE
N7svmLN2xyntRKr/glq1K6FIXkeNsvZEMAGVoLfbR8tVpWv+wLZeu8iukoW22Oia
L/N9AoGAAx2Ul1eK1el/HQoyGqQ6EzjcdpoUoM8x+acb5iVwVx72EBr+o3DDZLUr
ESAKFBrp3Iy1FMmpxhZmw12+41jBSaAP8d1CDAOTqImcRpzJ3L4zLJ9Pxo9/CjXh
qIA5xQ5l1jymIDsuUfDaNlDpfKpCb0tDnMmPscKlXvYITCcVtDE=
-----END RSA PRIVATE KEY-----');
	
	define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
	define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
	define('BAOKIM_API_QUERY_TRANSACTION','/payment/order/queryTransaction');
	define('BAOKIM_API_PAYMENT','/payment/order/version11');
	
	define('BAOKIM_URL','https://www.baokim.vn');
	//define('BAOKIM_URL','http://baokim.dev');
	//define('BAOKIM_URL','http://timnguoicho.');
	
	//Phương thức thanh toán bằng thẻ nội địa
	define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
	//Phương thức thanh toán bằng thẻ tín dụng quốc tế
	define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
	//Dịch vụ chuyển khoản online của các ngân hàng
	define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
	//Dịch vụ chuyển khoản ATM
	define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
	//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
	define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);
}

?>