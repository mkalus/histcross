/**
 * Holds information in vertices
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

/**
 * @author mkalus
 *
 */
public class Vertex {
	/**
	 * Vertex data
	 */
	private final int id, pictogram_id;
	private final String title, start, stop, vertexType;
	
	/**
	 * Coordinates and graphics data
	 */
	private int x = -1, y = -1;
	private boolean printBig = true;
	private int x0, y0, x1, y1; //graphics dimensions
	
	/**
	 * Constructor
	 * @param id
	 * @param title
	 * @param start
	 * @param stop
	 * @param pictogram_id
	 * @param vertexType
	 */
	public Vertex(int id, String title, String start, String stop, int pictogram_id, String vertexType) {
		this.id = id;
		this.title = title;
		this.start = start;
		this.stop = stop;
		this.pictogram_id = pictogram_id;
		this.vertexType = vertexType;
	}
	
	/**
	 * @return the x
	 */
	public int getX() {
		return x;
	}

	/**
	 * @param x
	 *            the x to set
	 */
	public void setX(int x) {
		this.x = x;
	}

	/**
	 * @return the y
	 */
	public int getY() {
		return y;
	}

	/**
	 * @param y
	 *            the y to set
	 */
	public void setY(int y) {
		this.y = y;
	}
	
	public void setXY(int x, int y) {
		this.x = x;
		this.y = y;
	}

	/**
	 * @return the printBig
	 */
	public boolean isPrintBig() {
		return printBig;
	}

	/**
	 * @param printBig
	 *            the printBig to set
	 */
	public void setPrintBig(boolean printBig) {
		this.printBig = printBig;
	}

	/**
	 * @return the id
	 */
	public int getId() {
		return id;
	}

	/**
	 * @return the pictogram_id
	 */
	public int getPictogram_id() {
		return pictogram_id;
	}

	/**
	 * @return the title
	 */
	public String getTitle() {
		return title;
	}

	/**
	 * @return the start
	 */
	public String getStart() {
		return start;
	}

	/**
	 * @return the stop
	 */
	public String getStop() {
		return stop;
	}

	/**
	 * @return the vertexType
	 */
	public String getVertexType() {
		return vertexType;
	}

	/**
	 * @return the x0
	 */
	public int getX0() {
		return x0;
	}

	/**
	 * @return the y0
	 */
	public int getY0() {
		return y0;
	}

	/**
	 * @return the x1
	 */
	public int getX1() {
		return x1;
	}

	/**
	 * @return the y1
	 */
	public int getY1() {
		return y1;
	}
	
	/**Set dimensions of element
	 * @param x0
	 * @param y0
	 * @param x1
	 * @param y1
	 */
	public void setDimensions(int x0, int y0, int x1, int y1) {
		this.x0 = x0;
		this.y0 = y0;
		this.x1 = x1;
		this.y1 = y1;
	}
	
	/**Tests coordinates if they are contained in the vertex
	 * @param x
	 * @param y
	 * @return
	 */
	public boolean withinVertex(int x, int y) {
		if (x >= x0 && x <= x1 &&
				y >= y0 && y <= y1)
			return true;
		return false;
	}
}
