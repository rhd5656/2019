<?php
    include("./common.php");

    session_start();
    $isLogin = false;   // 로그인 할 수 있는지

    /* 유저 DB에서 받아온 ID와 매치 시키기 */
    $sql = "SELECT * FROM `USERS` WHERE `USERID` = '". $_POST['loginID'] ."';";
    openDB($userConn, 'ganiLibrary', $sql, $userResult);

    /* 관리자 DB에서 받아온 ID와 매치 시키기 */
    $sql = "SELECT * FROM `ADMIN` WHERE `ADMINID` = '". $_POST['loginID'] ."';";
    openDB($adminConn, 'ganiLibrary', $sql, $adminResult);
    
    /* 일반회원 로그인 */
    while($row = mysqli_fetch_assoc($userResult)) {
        if($row['USERPASSWORD'] == md5($_POST['loginPW'])) {
            
            $_SESSION['memberID'] = $row['USERID'];
            $_SESSION['memberIDNum'] = $row['ID'];
            // setcookie("loginID", $row['USERID'], time() + (86400 * 30), '/');

            $isLogin = true;		    
        }
    }

    /* 관리자 로그인 */
    while($row = mysqli_fetch_assoc($adminResult)) {
        if($row['ADMINPASSWORD'] == md5($_POST['loginPW'])) {
            
            $_SESSION['adminID'] = $row['ADMINID'];
            $_SESSION['adminIDNum'] = $row['ID'];
            // setcookie("loginID", $row['USERID'], time() + (86400 * 30), '/');

            $isLogin = true;		    
        }
    }

    /* DB 닫기 */
    closeDB($userConn, $userResult);
    closeDB($adminConn, $adminResult);

    /* 최종 페이지 넘김 */
    if($isLogin) {
        echo "<script>alert('로그인 되었습니다.')</script>";
        echo "<script>window.open('../index.php', '_self');</script>";
    }
    else {
        echo "<script>alert('해당 아이디나 비밀번호가 잘못되었습니다.')</script>";
		echo "<script>window.open('../index.php', '_self');</script>";
    }








// 	$conn= mysqli_connect("127.0.0.1", "gani", "gani", "ganiLibrary");
// 	if(!$conn){
// 		echo "데이터베이스를 연결할 수 없습니다.".mysqli_error($conn);
// 		mysqli_close($conn);
// 		exit;
// 	}
// 	if(!mysqli_select_db($conn,"ganiLibrary")){
// 		echo "데이터베이스를 찾을 수 없습니다.".mysqli_error($conn);
// 		mysqli_close($conn);
// 		exit;
// 	}

//     session_start();

// /*
// ----------------------------------------------------------------------------------
// 일반 유저 로그인 확인
// */
//     $sql = "SELECT * FROM `USERS` WHERE `USERID` = '". $_POST['loginID'] ."';";
//     $result = mysqli_query($conn,$sql);
    
// 	if(!$result){
// 		echo "해당 데이터베이스의 결과 값을 가져올 수 없습니다.".mysqli_error($conn);
        
// 		// echo "<script>alert('해당 아이디를 찾을 수 없습니다.')</script>";
// 		// echo "<script>window.open('../index.php', '_self');</script>";
		
// 	}
    
//     if(mysqli_num_rows($result) == 0) {
//         echo "해당 데이터베이스의 데이터가 없습니다.".mysqli_error($conn); 
        

//         // echo "<script>alert('해당 아이디를 찾을 수 없습니다.')</script>";
// 		// echo "<script>window.open('../index.php', '_self');</script>";
		
//     }
    
//     while($row = mysqli_fetch_assoc($result)) {
//         if($row['USERPASSWORD'] == md5($_POST['loginPW'])) {
            
//             $_SESSION['memberID'] = $row['USERID'];
//             $_SESSION['memberIDNum'] = $row['ID'];
//             // setcookie("loginID", $row['USERID'], time() + (86400 * 30), '/');

//             $isLogin = true;

//             // echo "<script>alert('로그인 되었습니다.')</script>";
// 		    // echo "<script>window.open('../index.php', '_self');</script>";
		    
//         }
//         else {

            

//             // echo "<script>alert('해당 아이디의 비밀번호가 잘못되었습니다.')</script>";
// 		    // echo "<script>window.open('../index.php', '_self');</script>";
		    
//         }
//     }

// /*
// ----------------------------------------------------------------------------------
// 관리자 유저 로그인 확인
// */
//     $sql = "SELECT * FROM `ADMIN` WHERE `ADMINID` = '". $_POST['loginID'] ."';";
//     $result = mysqli_query($conn,$sql);
    
// 	if(!$result){
// 		echo "해당 데이터베이스의 결과 값을 가져올 수 없습니다.".mysqli_error($conn);
        
        

// 		// echo "<script>alert('해당 아이디를 찾을 수 없습니다.')</script>";
// 		// echo "<script>window.open('../index.php', '_self');</script>";
		
// 	}
    
//     if(mysqli_num_rows($result) == 0) {
//         echo "해당 데이터베이스의 데이터가 없습니다.".mysqli_error($conn); 

        

//         // echo "<script>alert('해당 아이디를 찾을 수 없습니다.')</script>";
// 		// echo "<script>window.open('../index.php', '_self');</script>";
		
//     }
    
//     while($row = mysqli_fetch_assoc($result)) {
//         if($row['ADMINPASSWORD'] == md5($_POST['loginPW'])) {
            
//             $_SESSION['adminID'] = $row['ADMINID'];
//             $_SESSION['adminIDNum'] = $row['ID'];
//             // setcookie("loginID", $row['USERID'], time() + (86400 * 30), '/');

//             $isLogin = true;

//             // echo "<script>alert('로그인 되었습니다.')</script>";
// 		    // echo "<script>window.open('../index.php', '_self');</script>";
		    
//         }
//         else {

            

//             // echo "<script>alert('해당 아이디의 비밀번호가 잘못되었습니다.')</script>";
// 		    // echo "<script>window.open('../index.php', '_self');</script>";
		    
//         }
//     }
//     mysqli_free_result($result);
//     mysqli_close($conn);

//     if($isLogin) {
//         echo "<script>alert('로그인 되었습니다.')</script>";
//         echo "<script>window.open('../index.php', '_self');</script>";
//     }
//     else {
//         echo "<script>alert('해당 아이디나 비밀번호가 잘못되었습니다.')</script>";
// 		echo "<script>window.open('../index.php', '_self');</script>";
//     }
?>