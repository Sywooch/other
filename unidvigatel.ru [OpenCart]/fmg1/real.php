<script type="text/javascript">
window.onload = changeBG;
function changeBG() {
  var first = 1;		// ������ ��������
  var last = 7;		// ��������� ��������
  var path = 'http://unidvigatel.com/fmg1/';		// ���� � �������� � ����������
 
  var img_src='url("'+path+getRandomInt(first,last)+'.jpg")';

  var div = document.images("main");
  div.src=img_src;
}
function getRandomInt(min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>

<img id="main" width="374" height="100" src="" />
