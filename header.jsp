<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>header</title>
<link rel="stylesheet" href="./css/casablanca.css">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
<body>
	<div id="top">
		<div id="logo">
			<a href="HomeAction">casablanca</a>
		</div>
		<ul>
			<s:if test="#session.logined==1">
				<li><a href="LogoutAction"><i class="fas fa-sign-out-alt"></i>ログアウト</a></li>
			</s:if>
			<s:else>
				<li><a href="GoLoginAction"><i class="fas fa-sign-in-alt"></i>ログイン</a></li>
			</s:else>
			<s:if test="#session.logined==1">
				<li><a href="MyPageAction"><i class="fas fa-address-card"></i>マイページ</a></li>
			</s:if>
				<li><a href="ProductListAction"><i class="fas fa-gift"></i>商品一覧</a></li>
				<li><a href="CartAction"><i class="fas fa-shopping-cart"></i>カート</a></li>
		</ul>
	</div>
	<div id="search">
		<s:form action="SearchItemAction">
		<s:select name="categoryId" class="slct" list="#session.mCategoryDtoList" listKey="categoryId" listValue="categoryName"/>
		<s:textfield name="keywords" cssClass="slct_key" value="%{keywords}" placeholder="検索ワード" />
		<button type="submit" class="submit_key" onclick="goSearchItemAction();"><i class="fas fa-search glass"></i></button>
		</s:form>
	</div>
</body>
</html>