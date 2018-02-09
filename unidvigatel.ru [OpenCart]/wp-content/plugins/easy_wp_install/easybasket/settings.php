<settings version="1.0" password="" timestamp="2011-05-31T12:01:18+01:00">
  <checkouts>
    <paypal enable="yes" sandbox="no" ipn="yes">
      <business>info@easybasket.co.uk</business>
      <currency-code>GBP</currency-code>
      <ipn-url>http://www.abc.co.uk/easybasket/</ipn-url>
    </paypal>
    <google enable="yes" sandbox="yes">
      <merchant-id>104962973967367</merchant-id>
      <merchant-key>nPOKKhMvJ7_VES4q6lhG3A</merchant-key>
      <currency>GBP</currency>
      <shipping-name>Royal Mail</shipping-name>
    </google>
  </checkouts>
  <form>
    <maps>
      <id>uniqueid</id>
      <title>heading</title>
      <description>subheading</description>
      <price>rrp</price>
      <image>photo</image>
      <url>address</url>
    </maps>
    <options>
      <option>size</option>
      <option>colour</option>
    </options>
    <postage>
      <per-item>postage</per-item>
      <first-item>postage1</first-item>
      <extra-items>postage2</extra-items>
    </postage>
  </form>
</settings><?php header('Location: index.php') ?>