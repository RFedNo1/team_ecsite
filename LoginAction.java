package com.internousdev.casablanca.action;
import java.util.List;
import java.util.Map;
import java.util.Objects;

import org.apache.struts2.interceptor.SessionAware;

import com.internousdev.casablanca.dao.CartInfoDAO;
import com.internousdev.casablanca.dao.DestinationInfoDAO;
import com.internousdev.casablanca.dao.MCategoryDAO;
import com.internousdev.casablanca.dao.UserInfoDAO;
import com.internousdev.casablanca.dto.DestinationInfoDTO;
import com.internousdev.casablanca.dto.MCategoryDTO;
import com.internousdev.casablanca.dto.UserInfoDTO;
import com.internousdev.casablanca.util.InputChecker;
import com.opensymphony.xwork2.ActionSupport;

public class LoginAction extends ActionSupport implements SessionAware {
	private String loginId;
	private String password;
	private boolean saveLoginStatus;
	private String passwordIncorrectErrorMessage;
	private List<DestinationInfoDTO> destinationInfoDtoList;
	private List<String> loginIdErrorMessageList;
	private List<String> passwordErrorMessageList;
	Map<String, Object> session;

	public String execute() {
		String result = ERROR;
		if (loginId == null || password == null) {
			//nullが入る場合は何も処理をせずにERRORを返す
		} else {
			/* フォーム入力記憶 */
			if (saveLoginStatus) {
				session.put("saveLoginStatus", saveLoginStatus);
				session.put("loginIdTemp", loginId);
			} else {
				session.remove("saveLoginStatus");
			}
			/* 入力チェック */
			InputChecker inputChecker = new InputChecker();
			loginIdErrorMessageList = inputChecker.doCheck("ログインID", loginId, 1, 8, true, false, false, true, false, false, false, false, false);
			passwordErrorMessageList = inputChecker.doCheck("パスワード", password, 1, 16, true, false, false, true, false, false, false, false, false);

			/* 入力チェックがOKの場合、ログイン処理へ。NGの場合は即ERRORをreturn */
			if (loginIdErrorMessageList.size()==0 && passwordErrorMessageList.size()==0) {
				UserInfoDAO userInfoDAO = new UserInfoDAO();
				UserInfoDTO userInfoDTO = userInfoDAO.getLoginInfo(loginId, password);

				/* ログインOKだった場合、DBカラム"logined"を1にupdate。
				 * そのlogined=1をsessionへ格納し、以降ログイン済みフラグとして利用 */
				if (loginId.equals(userInfoDTO.getUserId()) && password.equals(userInfoDTO.getPassword())) {
					userInfoDAO.login(loginId, password);
					result = SUCCESS;
					session.put("loginId", userInfoDTO.getUserId());
					session.put("logined", "1");

					/* カート追加時の一時IDセッションが残っているか判定 */
					if(session.containsKey("tempUserId")) {
						/* カート決済ボタンから来たか判定 */
						if (Objects.equals(session.get("fromCart"), true)) {
							/* DB cart_infoテーブルの一時IDをログインユーザIDとリンクさせる */
							CartInfoDAO cartInfoDAO = new CartInfoDAO();
							int count = cartInfoDAO.linkToLoginId(session.get("tempUserId").toString(), loginId);
							if (count > 0) {
								session.remove("tempUserId");
								/* 再ログイン後に決済画面へ遷移しないようにセッションからフラグを削除 */
								session.remove("fromCart");
								/* 宛先情報をsettlementConfirm.jspで表示用に生成 */
								DestinationInfoDAO destinationInfoDAO = new DestinationInfoDAO();
								destinationInfoDtoList = destinationInfoDAO.getDestinationInfo(loginId);
								result = "gotosettlementconfirm";
							}
						}
					}
					/* カートの決済ボタン経由(SettlementConfirmAction)でログイン画面にきたかどうか判定 */
				} else {
					passwordIncorrectErrorMessage = "入力されたパスワードが異なります。";
					result = INPUT;
				}
			} else {
				result = INPUT;
			}
		}
		if(!session.containsKey("mCategoryDtoList")) {
			MCategoryDAO mCategoryDAO=new MCategoryDAO();
			List<MCategoryDTO> mCategoryDtoList= mCategoryDAO.getMCategoryList();
			session.put("mCategoryDtoList", mCategoryDtoList);
		}
		return result;
	}

	public void setLoginId(String loginId) {
		this.loginId = loginId;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public void setSaveLoginStatus(boolean saveLoginStatus) {
		this.saveLoginStatus = saveLoginStatus;
	}
	public String getPasswordIncorrectErrorMessage() {
		return passwordIncorrectErrorMessage;
	}
	public List<String> getLoginIdErrorMessageList() {
		return loginIdErrorMessageList;
	}
	public List<String> getPasswordErrorMessageList() {
		return passwordErrorMessageList;
	}
	public List<DestinationInfoDTO> getDestinationInfoDtoList() {
		return destinationInfoDtoList;
	}
	public void setSession(Map<String, Object> session) {
		this.session = session;
	}
}
