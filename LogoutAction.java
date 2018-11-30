package com.internousdev.casablanca.action;

import java.util.List;
import java.util.Map;
import java.util.Objects;

import org.apache.struts2.interceptor.SessionAware;

import com.internousdev.casablanca.dao.MCategoryDAO;
import com.internousdev.casablanca.dao.UserInfoDAO;
import com.internousdev.casablanca.dto.MCategoryDTO;
import com.opensymphony.xwork2.ActionSupport;

public class LogoutAction extends ActionSupport implements SessionAware {
	private Map<String, Object> session;

	public String execute() {
		String result = SUCCESS;

		/* ログイン状態であるかチェック */
		if (Objects.equals(session.get("logined"), "1")) {
			UserInfoDAO userInfoDAO = new UserInfoDAO();

			/* loginedカラムを"0"にupdate */
			userInfoDAO.logout(session.get("loginId").toString());
			session.remove("logined");
			session.remove("loginId");
		}
		if(!session.containsKey("mCategoryDtoList")) {
			MCategoryDAO mCategoryDAO = new MCategoryDAO();
			List<MCategoryDTO> mCategoryDtoList = mCategoryDAO.getMCategoryList();
			session.put("mCategoryDtoList", mCategoryDtoList);
		}
		return result;
	}

	public void setSession(Map<String, Object> session) {
		this.session = session;
	}
}
