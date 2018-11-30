<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@ taglib prefix="s" uri="/struts-tags" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css"/>
<title>ログイン</title>
</head>
<body>
	<div class = "contents">
		<s:include value="header.jsp"/>
	<div class = "title">ログイン</div>
		<s:if test="!loginIdErrorMessageList.isEmpty()">
		<div class = "error-message">
			<s:iterator value="loginIdErrorMessageList">
				<s:property/>
			</s:iterator>
		</div>
		</s:if>
		<s:if test="!passwordErrorMessageList.isEmpty()">
		<div class = "error-message">
			<s:iterator value="passwordErrorMessageList">
				<s:property/>
			</s:iterator>
		</div>
		</s:if>
		<s:if test="!passwordIncorrectErrorMessage.isEmpty()">
			<div class = "error-message">
				<s:property value="passwordIncorrectErrorMessage"/>
			</div>
		</s:if>
		<div class = "input_login">
			<s:form id="form" action="LoginAction">
			<div class="loginIdMargin">
				<span class = "form_label">ログインID:</span>
			</div>
			<div class = "form_box_loginID">
				<s:if test="#session.saveLoginStatus">
					<s:textfield name="loginId" value="%{#session.loginIdTemp}" autocomplete="off" class="txt" />
				</s:if>
				<s:else>
					<s:textfield name="loginId" label="ログインID" class="txt" />
				</s:else>
			</div>
			<div class = "form_label">
				パスワード:
				<div>
					<div class="space">
						<span class="resetPass_btn">
							<a href='<s:url action="ResetPasswordAction"/>' tabindex="-1">パスワードの変更</a>
						</span>
					</div>
				</div>
			</div>
			<div class = "form_box_password">
				<s:password name="password" label="パスワード" class="txt" autocomplete="new-password"/>
			</div>
			<div class="form_label">
				<s:if test="#session.saveLoginStatus">
					<label>ログインID保存
					<s:checkbox name="saveLoginStatus" checked="checked"/>
					</label>
				</s:if>
				<s:else>
					<label>ログインID保存
					<s:checkbox name="saveLoginStatus"/>
					</label>
				</s:else>
				</div>
				<s:submit value="ログイン" class="btn_blue"/>
			</s:form>
			</div>
			<div>
				<s:form action="CreateUserAction">
					<s:submit value="新規ユーザー登録" class="btn_gray"/>
				</s:form>
		</div>
	</div>
<s:include value="footer.jsp"/>
</body>
</html>