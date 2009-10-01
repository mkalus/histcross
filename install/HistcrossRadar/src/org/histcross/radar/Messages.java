/**
 * Messages class for localized messages
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.util.Locale;
import java.util.MissingResourceException;
import java.util.ResourceBundle;

public class Messages {
	private static final String BUNDLE_NAME = "org.histcross.radar.messages"; //$NON-NLS-1$

	private static ResourceBundle RESOURCE_BUNDLE = null;

	private Messages() {
	}

	public static String getString(String key) {
		//set default language, if not set
		if (RESOURCE_BUNDLE == null) setLanguage();
		try {
			return RESOURCE_BUNDLE.getString(key);
		} catch (MissingResourceException e) {
			return '!' + key + '!';
		}
	}
	
	/**
	 * Sets the default system language as resource language
	 */
	public static void setLanguage() {
		RESOURCE_BUNDLE = ResourceBundle.getBundle(BUNDLE_NAME);
	}
	
	/**
	 * Sets a manual language as resource language
	 * @param lang
	 */
	public static void setLanguage(String lang) {
		Locale.setDefault(new Locale(lang));
	}
}
