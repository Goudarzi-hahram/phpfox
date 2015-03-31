<upgrade>
	<phpfox_update_menus>
		<menu>
			<module_id>user</module_id>
			<parent_var_name />
			<m_connection>main</m_connection>
			<var_name>menu_browse</var_name>
			<ordering>3</ordering>
			<url_value>user.browse</url_value>
			<version_id>2.0.0alpha1</version_id>
			<disallow_access />
			<module>user</module>
			<mobile_icon>users</mobile_icon>
			<value />
		</menu>
	</phpfox_update_menus>
	<blocks>
		<block>
			<type_id>0</type_id>
			<m_connection>core.index-visitor</m_connection>
			<module_id>user</module_id>
			<component>featured</component>
			<location>1</location>
			<is_active>1</is_active>
			<ordering>3</ordering>
			<disallow_access />
			<can_move>0</can_move>
			<title>Featured Users for Guests</title>
			<source_code />
			<source_parsed />
		</block>
	</blocks>
	<phpfox_update_blocks>
		<block>
			<type_id>0</type_id>
			<m_connection>core.index-visitor</m_connection>
			<module_id>user</module_id>
			<component>register</component>
			<location>3</location>
			<is_active>1</is_active>
			<ordering>1</ordering>
			<disallow_access />
			<can_move>0</can_move>
			<title>User SignUp for Guests</title>
			<source_code />
			<source_parsed />
		</block>
	</phpfox_update_blocks>
</upgrade>