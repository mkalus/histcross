/**
 * Holds information about the relation between two vertices
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 */
package org.histcross.radar;

/**
 * @author mkalus
 *
 */
public class Relation {
	/**
	 * Relation data
	 */
	private final int id, pictogram_id;
	private final String title, start, stop;
	private final Vertex fromVertex, toVertex;

	/**
	 * Constructor
	 * @param id
	 * @param fromVertex
	 * @param toVertex
	 * @param title
	 * @param start
	 * @param stop
	 * @param pictogram_id
	 */
	public Relation(int id, Vertex fromVertex, Vertex toVertex, String title, String start, String stop, int pictogram_id) {
		this.id = id;
		this.fromVertex = fromVertex;
		this.toVertex = toVertex;
		this.title = title;
		this.start = start;
		this.stop = stop;
		this.pictogram_id = pictogram_id;
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
	 * @return the fromVertex
	 */
	public Vertex getFromVertex() {
		return fromVertex;
	}

	/**
	 * @return the toVertex
	 */
	public Vertex getToVertex() {
		return toVertex;
	}

}
