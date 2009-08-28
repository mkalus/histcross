/**
 * Abstract settings class
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

import java.awt.Color;

/**
 * @author mkalus
 *
 */
abstract public class RadarSettings {
	/**
	 * Application status codes
	 */
	public static final int APP_OK = 1; //app ok
	public static final int APP_LOADING = 2; //loading status
	public static final int APP_PARMERR = 3; //parameters error
	public static final int APP_XMLERR = 4; //xml/document error

	/**
	 * Graphics constants/variables
	 */
	public static int frameWidth = 720; //Width of window
	public static int frameHeight = 720; //Height of window
	public static Color frameBackgroundcolor = Color.WHITE; //Color of background
	public static Color roundRectfill = new Color(255, 204, 51); //round rect border
	public static Color roundRectborder = new Color(255, 204, 0); //round rect fill
	public static Color infoTextHead = new Color(87, 94, 106); //round rect fill
	public static Color roundRectRfill = new Color(204, 204, 153); //round rect border
	public static Color roundRectRborder = new Color(204, 204, 102); //round rect fill
	public static Color infoTextRHead = new Color(51, 153, 102); //round rect fill
	public static Color infoBoxRectfill = new Color(79, 79, 79); //round rect border
	public static Color infoBoxRectborder = new Color(79, 79, 79); //round rect fill
	public static Color infoBoxTextHead = new Color(255, 228, 181); //round rect fill
	public static Color relationColor = new Color(51, 51, 204); //round rect fill
	public static int radius1 = 300; //radius center/2nd level elements
	public static int radius2 = 10; //radius 2nd/3nd level elements
}
