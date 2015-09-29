/* FIRST PROCEDURE */

USE [mubusassessment]
GO
/****** Object:  StoredProcedure [dbo].[getURLbyGroupIdAndSection]    Script Date: 9/28/2015 3:26:52 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		cwm
-- Create date: 9-28-2015
-- Description:	Query DB for URL_Name and URL_Address for a specific Group_ID
-- =============================================
ALTER PROCEDURE [dbo].[getURLbyGroupIdAndSection]
	@groupid varchar(30)
AS
	SELECT dashboard_urls.url_name, dashboard_urls.url_address, dashboard_urls.section_id, dashboard_urls.topic_id FROM dashboard_urls
	INNER JOIN dashboard_urls_by_group
		ON dashboard_urls.url_name = dashboard_urls_by_group.url_name JOIN dashboard_groups
		ON dashboard_urls_by_group.group_id = dashboard_groups.group_id
	WHERE dashboard_groups.group_id = @groupid
	ORDER BY dashboard_urls.url_name ASC;

	/**************************/