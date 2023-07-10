//--送信ボタンを押したときの全エレメントチェック
function chksubmit(oj){
	
	//同意のチェック
	var flag = 0;

	if(!oj.doi.checked){
		flag = 1;
	}
	if(flag){
		window.alert('「同意する」にチェックして下さい。'); // チェックされていない場合は警告ダイアログを表示
		return false; // 送信を中止
	}

   //未入力エレメントの背景色をオレンジにする
   if(!!oj.style){
     if(!oj.name.value) oj.name.style.backgroundColor='#DDDDDD'
     if(!oj.furi.value) oj.furi.style.backgroundColor='#DDDDDD'
     if(!oj.mail.value) oj.mail.style.backgroundColor='#DDDDDD'
     if(!oj.tel.value) oj.tel.style.backgroundColor='#DDDDDD' 

   }

   //対象エレメントがすべて入力済みでなければ送信不可とダイアログ
   if((oj.a1.value) && (oj.name.value) && (oj.furi.value) && (oj.mail.value) &&(oj.tel.value)) { 
        return true
   } else {
        alert('必須項目を入力してください')
        return false
   }

}
